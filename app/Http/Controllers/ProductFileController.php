<?php

namespace App\Http\Controllers;

use App\Models\ProductFile;
use Illuminate\Http\Request;

class ProductFileController extends Controller
{
    public function index($id){
        return ProductFile::GetImages($id);
    }
}
