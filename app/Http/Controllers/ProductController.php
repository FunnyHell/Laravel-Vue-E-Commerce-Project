<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::GetPagination();
    }

    public function showPage($id)
    {
        return view('product', ['product' => Product::GetProduct($id)]);
    }
}
