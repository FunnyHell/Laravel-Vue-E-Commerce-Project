<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::GetCategories();
    }

    public function FilteredProducts($category){
        return Product::GetFilteredProducts($category);
    }
}
