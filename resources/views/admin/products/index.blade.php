@extends('layout')
@section('content')
@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Images</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-800">₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->images as $img)
                                    <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 flex gap-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <a href="{{ route('products.delete', $product->id) }}" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

