<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorites', ['favorites' => Favorite::GetAll()]);
    }

    public function addFavorite(Request $request)
    {
        Favorite::Add($request);
        return redirect()->back();
    }

    public function deleteFavorite(Request $request)
    {
        Favorite::DeleteFavorite($request);
        return redirect('/favorites');
    }
}
