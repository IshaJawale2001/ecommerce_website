<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = 1;

        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Cart is empty.'], 400);
        }

        $amount = 0;

        foreach ($cartItems as $item) {
            $amount += $item->product->price * $item->quantity;
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'rcpt_' . now()->timestamp,
            'amount' => $amount * 100, // Amount in paise
            'currency' => 'INR'
        ]);

        // Store order (for now, assume payment success)
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $amount,
                'status' => 'success'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
                $item->delete();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Checkout failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
