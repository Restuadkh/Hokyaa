<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $products = Product::with('photos')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category' => 'required|string',
        ]);

        $product = Product::create($request->all());

        $filename = [];
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public/product_photos', $filename);
                $product->photos()->create([
                    'photo_path' => 'storage/product_photos/' . $filename,
                    'product_id' => $product->product_id,
                ]);
            }
        }

        // dd($product);
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category' => 'required',
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update data produk
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
        // Cari produk berdasarkan ID dan hapus
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
