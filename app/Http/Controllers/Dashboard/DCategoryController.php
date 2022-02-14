<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class DCategoryController extends Controller
{
    public function index(Request $request) 
    {
        $categories = Category::latest()->get();
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {   
        return view('dashboard.category.create');
    }


    public function store(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'title' => 'required|unique:categories|min:3|max:50',
            'slug' => 'required|alpha_dash|regex:/^[-a-z\s]+$/|unique:categories|min:3|max:30',
        ]);

        // add category
        $category = new Category;
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->save();

        // redirect list category
        return redirect()->route('d.category.index');
    }


    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('dashboard.category.edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $category = Category::where('slug', $request->slug_base)->first();

        $validated = $request->validate([
            'title' => 'required|min:3|max:255|unique:categories,title,'.$category->id,
            'slug' => 'required|alpha_dash|min:3|max:30|regex:/^[-a-z\s]+$/|unique:categories,slug,'.$category->id,
        ]);

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->update();

        return redirect()->route('d.category.index');
    }

    public function destroy(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();
        if($category)
        {
            $category->delete();
            Post::where('category_id', $category->id)->delete();
        }
        return redirect()->route('d.category.index');
    }
}
