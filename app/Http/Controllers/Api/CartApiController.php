<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartApiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cartItem = Cart::updateOrCreate(
                ['user_id' => 1, 'product_id' => $request->product_id],
                ['quantity' => DB::raw("quantity + {$request->quantity}")]

            );

            return response()->json([
                'status' => true,
                'message' => 'Product added to cart successfully.',
                'data' => $cartItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add to cart.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function index()
{
    try {
        $userId = 1;

        $items = Cart::with('product')
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->get();

        $cartItems = [];
        $grandTotal = 0;

        foreach ($items as $item) {
            $lineTotal = $item->product->price * $item->quantity;
            $grandTotal += $lineTotal;

            $cartItems[] = [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'price' => (float) $item->product->price,
                'quantity' => $item->quantity,
                'total' => $lineTotal
            ];
        }

        return response()->json([
            'status' => true,
            'cart_items' => $cartItems,
            'cart_total' => $grandTotal
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error loading cart.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    try {
        $cart = Cart::where('id', $id)->where('user_id', 1)->first();

        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Cart item updated successfully.',
            'data' => $cart
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error updating cart item.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function destroy($id)
{
    try {
        $cart = Cart::where('id', $id)->where('user_id', 1)->first();

        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cart item deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error deleting cart item.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
