<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('images')
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => (float) $product->price,
                        'images' => $product->images->map(function ($img) {
                            return asset('storage/' . $img->image_path);
                        })->toArray(),
                    ];
                });

            return response()->json([
                'status' => true,
                'products' => $products,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
