<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        return view('category.create');
    }
}
