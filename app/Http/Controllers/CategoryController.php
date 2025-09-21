<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $all_categories = $this->category->paginate(10);
        return view('admin.category')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:20|unique:categories,category'
        ]);

        $this->category->category = $request->category;
        $this->category->save();

        return redirect()->back();
    }

    
    public function edit($id)
    {
        $cate_id = $this->category->findOrFail($id);

        return view('admin.category-edit')->with('cate_id', $cate_id);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|max:20|unique:categories,category'
        ]);

        $category = $this->category->findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('admin.category');
    }

    
    public function delete($id)
    {
        $this->category->destroy($id);

        return redirect()->back();
    }
}
