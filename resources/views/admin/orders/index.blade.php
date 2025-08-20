@extends('layout')
@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-800">Order List</h2>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Order ID</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total Amount</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-800">#{{ $order->id }}</td>
                    <td class="px-6 py-4 text-gray-800">₹{{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-6 py-4 text-green-600 font-semibold capitalize">{{ $order->status }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
