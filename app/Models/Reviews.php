<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Reviews extends Model
{
    use HasFactory;

    public static function GetReviews($id)
    {
        return DB::table('reviews')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'reviews.author_id');
            })
            ->select('reviews.*', 'users.name')
            ->where('product_id', '=', $id)
        ->paginate(10);
    }

    public static function AddReview(\Illuminate\Http\Request $request, $id)
    {
        DB::table('reviews')
            ->insert(['product_id'=>$id, 'author_id'=>Auth::user()->id, 'text'=>$request->input('text')]);
        return 1;
    }
}
