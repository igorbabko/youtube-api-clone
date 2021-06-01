<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::get();
    }

    public function show(Category $category)
    {
        return $category;
    }
}
