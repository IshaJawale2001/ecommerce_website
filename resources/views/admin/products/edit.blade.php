@extends('layout')
@section('content')
@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
    @csrf
    <div class="mb-6">
        <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required class="w-full border border-gray-300 rounded-md p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200" placeholder="Enter product name">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="price" class="block text-gray-700 font-medium mb-2">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ $product->price }}" required class="w-full border border-gray-300 rounded-md p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200" placeholder="Enter price (e.g., 99.99)">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Current Images:</label>
        <div class="flex flex-wrap gap-3">
            @foreach($product->images as $img)
                <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg shadow-sm">
            @endforeach
        </div>
    </div>

    <div class="mb-6">
        <label for="images" class="block text-gray-700 font-medium mb-2">Replace Images (Optional):</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*" class="w-full border border-gray-300 rounded-md p-3 file:border-0 file:bg-green-50 file:text-green-700 file:rounded file:px-3 file:py-2 file:cursor-pointer">
        @error('images')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-200 w-full sm:w-auto">Update Product</button>
</form>
@endsection
