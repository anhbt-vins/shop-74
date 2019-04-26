<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('parent',0)->get()
        ->map(function($query) {
            $query->sub = $this->getChildCategory($query->id);
            return $query;
        });
        //dd($categories);
    	return view('admin.category.index', compact('categories'));
    }
    private function getChildCategory($parent)
    {
        $categories = Category::where('parent', $parent)->get();
        if($categories->count() > 0) {
            $categories->map(function($query) {
                 $query->sub = $this->getChildCategory($query->id);
                return $query;
            });
            return $categories;
        }
        return null;
    }

    public function edit($category) {
        $categories = Category::where('parent',0)->get()
        ->map(function($query) {
            $query->sub = $this->getChildCategory($query->id);
            return $query;
        });
        $categoryEdit = Category::find($category);
    	return view('admin.category.edit', compact('categories','categoryEdit'));
    }
    public function create()
    {
    	return view('admin.category.create');
    }
    public function store(Request $request)
    {
        if(Category::where('name', $request->name)->get())
        {
            return back()->with('conflict','Conflict');
        }
    	$category = Category::create([
    		'name' => $request->name,
    		'parent' => $request->parent,
    	]);
    	return redirect('/admin/categories/'.$category->id.'/edit')->with('create', 'Category created');
    }
}
