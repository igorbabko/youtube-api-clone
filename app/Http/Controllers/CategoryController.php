<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        return [
            'All',
            'Trucks',
            'Tools'
        ];
    }
}
