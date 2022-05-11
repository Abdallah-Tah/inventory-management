<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::has('category')->get();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewDeletedProducts()
    {
        $products = Product::has('category')->onlyTrashed()->get();

        return view('products.deleted', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $product = validator($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
                //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);


            if ($product->fails()) {
                return redirect()->back()->with('error', 'Product could not be created');
            }

            if ($request->image) {
                $file = $request->image;
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/images/', $name);
            } else {
                $name = 'noimage.jpg';
            }

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;
            $product->image = $name;
            $product->save();




            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product could not be created');
        }
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
        try {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;
            $product->update();

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product could not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $products = Product::find($product->id);
            $products->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Product could not be deleted');
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            Product::withTrashed()->find($id)->restore();

            return redirect()->route('products.index')->with('success', 'Product restored successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Product could not be restored');
        }
    }

    /**
     * ForceDeleted the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        try {
            $products = Product::withTrashed()->find($id);
            $products->forceDelete();

            if($products){
                $image_path = public_path() . '/images/' . $products->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }else {
                return redirect()->back()->with('error', 'Product could not be deleted');
            }

           
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Product could not be deleted');
        }
    }
}
