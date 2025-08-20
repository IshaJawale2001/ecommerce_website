@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    <table class="w-full mb-6">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Product</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Price</th>
                <th class="p-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr class="border-b">
                    <td class="p-2">{{ $item->product->name }}</td>
                    <td class="p-2 text-center">{{ $item->quantity }}</td>
                    <td class="p-2 text-center">₹{{ number_format($item->product->price, 2) }}</td>
                    <td class="p-2 text-center">₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right mb-6">
        <h3 class="text-xl font-semibold">Total: ₹{{ number_format($total, 2) }}</h3>
    </div>

    <!-- Razorpay Custom Button -->
    <form action="{{ route('razorpay.payment') }}" method="POST" id="razorpay-form">
        @csrf
        <input type="hidden" name="amount" value="{{ $total }}">
        <button id="pay-button" type="button"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out">
            <i class="fas fa-credit-card mr-2"></i> Pay with Razorpay
        </button>
    </form>

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-button').onclick = function (e) {
            e.preventDefault();

            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{ $total * 100 }}",
                "currency": "INR",
                "name": "E-Commerce Shop",
                "description": "Test Transaction",
                "image": "https://yourlogo.com/logo.png",
                "handler": function (response) {
                    document.getElementById('razorpay-form').submit();
                },
                "prefill": {
                    "name": "Pratibha",
                    "email": "pratibha123@gmail.com"
                },
                "theme": {
                    "color": "#528FF0"
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
@endsection



{{-- @extends('layout')

@section('content')
    <h2 class="text-2xl font-semibold mb-6">Checkout</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.checkout.submit') }}">
        @csrf

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3">Product</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Quantity</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="border-t">
                            <td class="p-3">{{ $item->product->name }}</td>
                            <td class="p-3">₹{{ number_format($item->product->price, 2) }}</td>
                            <td class="p-3">{{ $item->quantity }}</td>
                            <td class="p-3">₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-6">
                <span class="text-lg font-semibold">Total: ₹{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                Place Order
            </button>
        </div>
    </form>
@endsection --}}
