<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PHẦN 1 — FRONT STORE (KHÁCH HÀNG)
    |--------------------------------------------------------------------------
    */
    // Trang chủ / → danh sách sản phẩm (homepage)
public function storefront()
{
    $products = Product::latest()->get();
    return view('products.shop', compact('products'));
}

    // /products → danh sách sản phẩm cho khách
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.shop', compact('products')); // VIEW KHÁCH
    }

    // /products/{id} → chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show_public', compact('product'));
    }


    /*
    |--------------------------------------------------------------------------
    | PHẦN 2 — ADMIN CRUD
    |--------------------------------------------------------------------------
    */

    // /admin/products
    public function adminIndex()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products')); // VIEW ADMIN
    }

    // /admin/products/create
    public function create()
    {
        return view('products.create');
    }

    // POST /admin/products
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|integer',
            'description' => 'nullable',
            'image'       => 'nullable|image',
            'stock'       => 'nullable|integer',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imageName,
            'stock'       => $request->stock ?? 10,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công');
    }

    // /admin/products/{product}/edit
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // PUT /admin/products/{product}
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|integer',
            'description' => 'nullable',
            'image'       => 'nullable|image',
            'stock'       => 'nullable|integer',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            if ($product->image && File::exists(public_path('uploads/' . $product->image))) {
                File::delete(public_path('uploads/' . $product->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imageName,
            'stock'       => $request->stock ?? $product->stock,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công');
    }

    // DELETE /admin/products/{product}
    public function destroy(Product $product)
    {
        if ($product->image && File::exists(public_path('uploads/' . $product->image))) {
            File::delete(public_path('uploads/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công');
    }
}
