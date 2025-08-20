@extends('layout')
@section('content')
<h2 class="text-xl font-semibold mb-4">Add to Cart</h2>

<form method="POST" action="{{ route('admin.cart.store') }}" class="bg-white p-6 rounded shadow">
    @csrf

    <label class="block mb-2">Product:</label>
    <select name="product_id" required class="w-full border p-2 mb-4 rounded">
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} (₹{{ $product->price }})</option>
        @endforeach
    </select>

    <label class="block mb-2">Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required class="w-full border p-2 mb-4 rounded" />

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
</form>
@endsection
