<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', 1)
            ->whereNull('deleted_at')
            ->get();

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('admin.checkout.index', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        DB::beginTransaction();
        try {
            $cartItems = Cart::with('product')
                ->where('user_id', 1)
                ->whereNull('deleted_at')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('admin.checkout')->with('error', 'Cart is empty.');
            }

            $order = Order::create([
                'user_id' => 1,
               // 'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity)
               'total_amount' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity)


            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                $item->delete(); // clear cart
            }

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}
