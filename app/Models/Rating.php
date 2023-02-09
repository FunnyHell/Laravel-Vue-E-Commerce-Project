<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
