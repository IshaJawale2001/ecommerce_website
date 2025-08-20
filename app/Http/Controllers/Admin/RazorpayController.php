<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {
        DB::beginTransaction();
        try {
            $userId = 1;

            $cartItems = Cart::with('product')
                ->where('user_id', $userId)
                ->whereNull('deleted_at')
                ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Cart is empty.');
            }

            $total = $request->input('amount');

            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $total,
                'status' => 'success'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                $item->delete(); // Clear cart
            }

            DB::commit();

            return redirect()->route('admin.orders.index')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Razorpay\Api\Api;
// use App\Models\Order;
// use App\Models\Cart;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;

// class RazorpayController extends Controller
// {
//     public function checkout()
//     {
//         $cartItems = Cart::with('product')->where('user_id', 1)->get();
//         $amount = 0;

//         foreach ($cartItems as $item) {
//             $amount += $item->product->price * $item->quantity;
//         }

//         return view('admin.orders.checkout', compact('cartItems', 'amount'));
//     }

//     public function payment(Request $request)
//     {
//         $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

//         $orderData = [
//             'receipt'         => Str::random(10),
//             'amount'          => $request->amount * 100, // amount in paise
//             'currency'        => 'INR',
//         ];

//         $razorpayOrder = $api->order->create($orderData);

//         $order_id = $razorpayOrder['id'];

//         session()->put('razorpay_order_id', $order_id);

//         return response()->json([
//             'order_id' => $order_id,
//             'amount' => $orderData['amount'],
//             'key' => config('services.razorpay.key'),
//         ]);
//     }

//     public function success(Request $request)
//     {
//         DB::beginTransaction();

//         try {
//             $order = new Order();
//             $order->user_id = 1;
//             $order->razorpay_payment_id = $request->razorpay_payment_id;
//             $order->amount = $request->amount / 100;
//             $order->status = 'paid';
//             $order->save();

//             // Optionally: clear cart
//             Cart::where('user_id', 1)->delete();

//             DB::commit();
//             return redirect()->route('orders.index')->with('success', 'Payment successful and order created.');
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return back()->with('error', 'Payment processing failed: ' . $e->getMessage());
//         }
//     }
// }

