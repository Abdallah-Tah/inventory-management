<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show()
    {
        $categories = Category::all();

        return view('categories.view', compact('categories'));
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
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category could not be created');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->name = $request->name;
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Category could not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       try{
            $categories = Category::findOrFail($category->id);
            $categories->delete();

            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category could not be deleted');
        }
    }


    public function getDeletedCategories()
    {
        $categories = Category::onlyTrashed()->get();

        return view('categories.deleted', compact('categories'));
    }

    public function restoreCategory($id)
    {
        try {
           
            Category::withTrashed()->find($id)->restore();

            return redirect()->route('categories.deleted')->with('success', 'Category restored successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category could not be restored');
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::withTrashed()->find($id);
            $category->forceDelete();

            return redirect()->route('categories.deleted')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category could not be deleted');
        }
    }
}
