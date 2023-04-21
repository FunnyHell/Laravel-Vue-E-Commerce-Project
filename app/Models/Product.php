<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    static public function GetPagination($id = null)
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
        if ($id) {
            $data = DB::table('products')
                ->LeftJoin('product_files', function ($join) {
                    $join->on('products.id', '=', 'product_files.product_id')
                        ->where('product_files.type', '=', 'card-img');
                })
                ->leftJoin('reviews', function ($join) {
                    $join->on('products.id', '=', 'reviews.product_id');
                })
                ->select('products.*', 'product_files.path', DB::raw('COUNT(reviews.product_id) as reviews'))
                ->where('products.seller_id', '=', $id)
                ->groupBy('products.id', 'product_files.path')
                ->paginate(15);
        }
        return response()->json($data);
    }

    static public function GetProduct($id)
    {
        $data = DB::table('products')
            ->where('products.id', '=', $id)
            ->join('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'main-img');
            })
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->leftJoin('ratings', function ($join) {
                $join->on('products.id', '=', 'ratings.product_id');
            })
            ->select('products.*', 'product_files.*', 'ratings.*')
            ->groupBy('products.id', 'product_files.id', 'reviews.id', 'ratings.id')
            ->get();
        dump($data[0]);
        return $data[0];
    }

    static public function GetRandom($id)
    {
        $category = DB::table('products')
            ->where('id', '=',$id)
            ->get('category');
        $data = DB::table('products')
            ->where('category', '=', $category[0]->category)
            ->inRandomOrder()
            ->take(9)
            ->LeftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'card-img');
            })
            ->get();
        return response()->json($data);
    }
}
