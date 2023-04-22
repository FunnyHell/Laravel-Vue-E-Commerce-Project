<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class Rating extends Model
{
    use HasFactory;

    static public function UpdateRating($id)
    {
        $rating = DB::table('rating')->where('product_id', '=', $id)
            ->select(DB::raw('AVG(ratings.value) as average'))->get();
        try {
            DB::table('products')->where('id', $id)
                ->update(['rating' => $rating]);
        } catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public static function SetRating($request, $id)
    {
        DB::table('ratings')
            ->insert(['product_id'=>$id, 'author_id'=>Auth::user()->id, 'value'=>(int)$request->input('rating')]);
        return 1;
    }
}
