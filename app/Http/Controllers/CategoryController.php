<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index', compact('categories'));
    }
    public function AddCategory()
    {
        return view('backend.category.add');
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create($request->all());
        $notification = array(
            'message' => 'Category added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('category.all')->with($notification);
    }
    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }
    public function UpdateCategory(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('category.all')->with('success', 'Category updated successfully.');
    }
    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.all')->with('success', 'Category deleted successfully.');
    }
}