@extends('layout')
@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Cart Quantity</h2>

<form method="POST" action="{{ route('admin.cart.update', $cart->id) }}" class="bg-white p-6 rounded shadow">
    @csrf

    <label class="block mb-2">Product:</label>
    <input type="text" value="{{ $cart->product->name }}" disabled class="w-full border p-2 mb-4 bg-gray-100 rounded" />

    <label class="block mb-2">Quantity:</label>
    <input type="number" name="quantity" min="1" value="{{ $cart->quantity }}" required class="w-full border p-2 mb-4 rounded" />

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
