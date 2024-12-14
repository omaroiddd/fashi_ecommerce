<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $categories = Category::get();
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->store('categories', 'public');
            $data['image'] = "storage/" . $fileName;
        }

        Category::create($data);

        return redirect(route('admin.categories.index'))->with('status', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findorFail($id);
        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->store('categories', 'public');
            $data['image'] = "storage/" . $fileName;
        }

        Category::findOrFail($id)->update($data);

        return redirect(route('admin.categories.index'))->with('status', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Category Deleted Successfully');
    }
}
