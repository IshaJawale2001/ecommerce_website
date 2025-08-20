<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    $imageName = time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path('uploads'), $imageName);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'uploads/' . $imageName
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Product creation failed: ' . $e->getMessage());
            return back()->with('error', 'Error adding product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'price' => $request->price
            ]);

            if ($request->hasFile('images')) {
                foreach ($product->images as $img) {
                    File::delete(public_path($img->image_path));
                    $img->delete();
                }

                foreach ($request->file('images') as $img) {
                    $imageName = time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path('uploads'), $imageName);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'uploads/' . $imageName
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Product update failed: ' . $e->getMessage());
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            foreach ($product->images as $img) {
                File::delete(public_path($img->image_path));
                $img->delete();
            }

            $product->delete();
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Product deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
