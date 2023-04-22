<?php

namespace App\Http\Controllers;

use App\Models\BuyingHistory;
use App\Models\Reviews;
use App\Models\User;
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

    public function GetRandom($id)
    {
        return Product::GetRandom($id);
    }

    public function PostProduct(Request $request)
    {
        Product::PostProduct($request);
        return redirect('/seller');
    }

    public function DeleteProduct($id)
    {
        Product::DeleteProduct($id);
        return redirect('/');
    }

    public function GetReviews($id)
    {
        return Reviews::GetReviews($id);
    }

    public function addReview(Request $request, $id)
    {
        Reviews::AddReview($request, $id);
        return redirect('/product/'.$id);
    }

    public function buyingProduct(Request $request, $id){
        BuyingHistory::AddNew($request, $id);
        return redirect('/product/'.$id);
    }
}
