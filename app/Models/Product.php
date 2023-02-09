<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    static public function GetPagination()
    {
        $data = DB::table('products')
            ->LeftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'card-img');
            })
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->select('products.*', 'product_files.path', DB::raw('COUNT(reviews.product_id) as reviews'))
            ->groupBy('products.id', 'product_files.path')
            ->paginate(15);
        return response()->json($data);
    }

    static public function GetProduct($id)
    {
        $data = DB::table('products')
            ->where('products.id', '=', $id)
            ->join('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id');
            })
            ->leftJoin('reviews', function ($join){
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->leftJoin('ratings', function ($join){
                $join->on('products.id', '=', 'ratings.product_id');
            })
            ->select('products.*', 'product_files.*', DB::raw('COUNT(reviews.product_id) as reviews'), 'ratings.*', DB::raw('AVG(ratings.value) as averageRating'))
            ->groupBy('products.id', 'product_files.id', 'ratings.id')
            ->get();
        return $data[0];
    }
}
