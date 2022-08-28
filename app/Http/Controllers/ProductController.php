<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'type' => 'required',
            'owner_email' => 'required|email',
            'expiry_date' => 'nullable|date|after:tomorrow',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if($request->has('image')){
            $image_path = $request->file('image')->store('products', 'public');
        }else{
            $image_path = 'products/default_product.jpg';
        }

        if($request->input('expiry_date')){
            $expiry_date = $request->input('expiry_date');
        }else{
            $expiry_date = Date('Y-m-d', strtotime('+7 days'));
        }

        $category = implode(', ', $request->input('category'));

        $modified_fields = [
            'image'=> $image_path,
            'category'=> $category,
            'expiry_date'=> $expiry_date
        ];

        $product = $request->user()->products()->create($request->except('category', 'expiry_date', 'image') + $modified_fields);
        return redirect()->route('products.show', $product->id)->with('success', 'Product created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        return view('products.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'type' => 'required',
            'owner_email' => 'required|email',
            'expiry_date' => 'nullable|date|after:tomorrow',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if($request->has('image')){
            if($product->image != 'products/default_product.jpg')
                unlink(public_path('storage/'.$product->image));
            $image_path = $request->file('image')->store('products', 'public');
            echo $image_path;
        }else{
            $image_path = 'products/default_product.jpg';
        }
        $category = implode(', ', $request->input('category'));

        $modified_fields = [
            'image'=> $image_path,
            'category'=> $category,
        ];

        $product->update($request->except('image', 'category') + $modified_fields);
        return redirect()->route('products.show', $product->id)->with('success', 'Product created successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != 'products/default_product.jpg')
            unlink(public_path('storage/'.$product->image));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
