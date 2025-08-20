@extends('layout')
@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-800">Order Details - #{{ $order->id }}</h2>

<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <p class="mb-2"><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
    {{-- <p><strong>Status:</strong> <span class="capitalize text-green-600">{{ $order->status }}</span></p> --}}
    <p class="mb-2"><strong>Status:</strong> {{ $order->status ?? 'Pending' }}</p>
<p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>

</div>

<h3 class="text-xl font-semibold mb-4 text-gray-700">Ordered Items</h3>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Product</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Price</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Quantity</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-800">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-gray-800">₹{{ number_format($item->price, 2) }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-gray-800">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
