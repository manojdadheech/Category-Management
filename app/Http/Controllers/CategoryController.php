<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // CategoryController.php
public function index()
{
    $categories = Category::with('parent')->get();
    return view('categories.index', compact('categories'));
}

public function create()
{
    $allCategories = Category::all();
    $dropdownOptions = Category::buildDropdownOptions($allCategories);

    return view('categories.create', compact('dropdownOptions'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'status' => 'required|in:1,2',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    Category::create($validated);
    return redirect()->route('categories.index')->with('success', 'Category created successfully.');
}

public function edit(Category $category)
{
    $category->load('children');
    $excludedIds = array_merge([$category->id], $category->allDescendantIds());

    $allCategories = Category::all();
    $dropdownOptions = Category::buildDropdownOptions($allCategories, null, '', $excludedIds);

    return view('categories.edit', compact('category', 'dropdownOptions'));
}

public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'status' => 'required|in:1,2',
        'parent_id' => 'nullable|exists:categories,id|not_in:'.$category->id,
    ]);

    $category->update($validated);
    return redirect()->route('categories.index')->with('success', 'Category updated.');
}

public function destroy(Category $category)
{
    $newParentId = $category->parent_id;
    Category::where('parent_id', $category->id)->update(['parent_id' => $newParentId]);
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted.');
}

}
