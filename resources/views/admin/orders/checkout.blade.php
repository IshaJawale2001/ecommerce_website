@extends('layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Checkout</h2>

<table class="w-full mb-6">
    <thead>
        <tr>
            <th class="text-left">Product</th>
            <th class="text-left">Qty</th>
            <th class="text-left">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p class="text-lg font-semibold mb-4">Total Amount: ₹{{ number_format($amount, 2) }}</p>

<button id="pay-button" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700">Pay with Razorpay</button>

<form id="success-form" action="{{ route('razorpay.success') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="amount" value="{{ $amount * 100 }}">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        fetch("{{ route('razorpay.payment') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amount: {{ $amount }} })
        })
        .then(res => res.json())
        .then(data => {
            const options = {
                key: data.key,
                amount: data.amount,
                currency: "INR",
                name: "Ecommerce Project",
                description: "Test Payment",
                order_id: data.order_id,
                handler: function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('success-form').submit();
                }
            };
            const rzp = new Razorpay(options);
            rzp.open();
        });
    };
</script>
@endsection
