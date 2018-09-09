<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Category $category)
    {
        $threads = Thread::where('category_id', $category->id)->get();
        return view('threads.index', compact('threads'));
    }


}
