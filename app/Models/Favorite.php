<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;

    public static function GetAll()
    {
        $favorites_array = DB::table('favorite')
            ->where('user_id', Auth::user()->id)
            ->get();
        $favorites = [];
        foreach ($favorites_array as $item) {
            array_push($favorites, DB::table('products')
                ->leftJoin('product_files', function ($join) {
                    $join->on('products.id', '=', 'product_files.product_id')
                        ->where('product_files.type', '=', "card-img");
                })
                ->where('products.id', $item->product_id)
                ->select('products.*', 'product_files.path')
                ->first());
        }
        return array_reverse($favorites);

    }

    public static function Add(\Illuminate\Http\Request $request)
    {
        DB::table('favorite')
            ->insert([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]);
    }

    public static function DeleteFavorite(\Illuminate\Http\Request $request)
    {
        DB::table('favorite')
            ->where('product_id', $request->id)
            ->limit(1)
            ->delete();
    }
}
