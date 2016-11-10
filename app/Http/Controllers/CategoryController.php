<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // GET         /category               @index
    // GET         /category/create        @create
    // POST        /category               @store
    // GET         /category/{id}          @show
    // GET         /category/{id}/edit     @edit
    // PUT/PATCH   /category/{id}          @update
    // DELETE      /category/{id}          @destroy
    
    public function create()
    {
        if (!Auth::check())
            return back();

        if (Auth::user()->can('create', Category::class))
        {
            $categories = Category::where('parent_id','=',null)->get();
            //dd('categories');
            //dd('Categories = ' . $categories);
            //dd($categories);
            return view('category.create', compact('categories'));
        }

        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);
        
        // dd($request->all());
        $category = new Category($request->all());
        
        $category->save();
        
        flash()->success('Success!', 'Category saved successfully');
        return back();

        
    }
}
