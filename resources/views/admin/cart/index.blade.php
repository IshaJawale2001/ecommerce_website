@extends('layout')
@section('content')
<h2 class="text-2xl font-semibold mb-6">Cart Items</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.cart.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Add to Cart</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Product</th>
            <th class="p-3 text-left">Quantity</th>
            <th class="p-3 text-left">Price</th>
            <th class="p-3 text-left">Total</th>
            <th class="p-3 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cartItems as $item)
        <tr class="border-t">
            <td class="p-3">{{ $item->product->name }}</td>
            <td class="p-3">{{ $item->quantity }}</td>
            <td class="p-3">₹{{ number_format($item->product->price, 2) }}</td>
            <td class="p-3">₹{{ number_format($item->quantity * $item->product->price, 2) }}</td>
            <td class="p-3 flex gap-2">
                <a href="{{ route('admin.cart.edit', $item->id) }}" class="text-blue-600">Edit</a>
                <a href="{{ route('admin.cart.delete', $item->id) }}" class="text-red-600" onclick="return confirm('Delete this item?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-right mt-4 text-lg font-semibold">
    Grand Total: ₹{{ number_format($total, 2) }}
</div>
@endsection
