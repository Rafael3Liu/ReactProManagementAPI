<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'description'=>'required',
            'price'=>'required'
            
        ]);
        
        if($request->hasFile('product_image')){
            $formFields['product_image'] = $request->file('product_image')->store('images','public');
        }
        return Product::create($formFields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);
    }
    /**
     * search the specified resource from storage.
     */
    public function search(string $title)
    {
        return Product::where('title','Like','%'.$title.'%')->get();
    }
}
