<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            ->where('products.is_deleted', '=', '0')
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
                ->where('products.is_deleted', '=', '0')
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
            ->leftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'main-img');
            })
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->leftJoin('ratings', function ($join) {
                $join->on('products.id', '=', 'ratings.product_id');
            })
            ->select('products.*', 'product_files.*', 'ratings.value')
            ->where('products.is_deleted', '=', '0')
            ->groupBy('products.id', 'product_files.id', 'reviews.id', 'ratings.id')
            ->get();
        return $data[0];
    }

    static public function GetRandom($id)
    {
        $category = DB::table('products')
            ->where('id', '=', $id)
            ->get('category');
        $data = DB::table('products')
            ->where('category', '=', $category[0]->category)
            ->inRandomOrder()
            ->take(9)
            ->LeftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'card-img');
            })
            ->where('products.is_deleted', '=', '0')
            ->select('products.*', 'product_files.path')
            ->get();
        return response()->json($data);
    }

    static public function GetFilteredProducts($category)
    {
        $c = DB::table('categories')->where('name', '=', $category)->first()->id;
        $data = DB::table('products')
            ->LeftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'card-img');
            })
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->select('products.*', 'product_files.path', DB::raw('COUNT(reviews.product_id) as reviews'))
            ->where('products.is_deleted', '=', '0')
            ->where('products.category', '=', $c)
            ->groupBy('products.id', 'product_files.path')
            ->paginate(15);
        return response()->json($data);
    }

    static public function GetSellersProducts($seller)
    {
        $s = DB::table('users')->where('id', '=', $seller)->first()->id;
        $data = DB::table('products')
            ->LeftJoin('product_files', function ($join) {
                $join->on('products.id', '=', 'product_files.product_id')
                    ->where('product_files.type', '=', 'card-img');
            })
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id');
            })
            ->select('products.*', 'product_files.path', DB::raw('COUNT(reviews.product_id) as reviews'))
            ->where('products.is_deleted', '=', '0')
            ->where('products.seller_id', '=', $s)
            ->groupBy('products.id', 'product_files.path')
            ->paginate(15);
        return response()->json($data);
    }

    private static function formatToParagraphs($text)
    {
        $paragraphs = preg_split("/[\r\n]+/", $text);
        $paragraphsHtml = '';
        foreach ($paragraphs as $paragraph) {
            $paragraphsHtml .= '<p>' . $paragraph . '</p>';
        }
        return $paragraphsHtml;
    }

    static public function PostProduct($request)
    {
        $main_img = $request->file('main-img');
        $sub_img = $request->file('sub-img');
        $url = ProductFile::SaveImg($main_img);
        $category = DB::table('categories')->where('name', '=', $request->input('category'))->get('id')[0];
        $product_id = DB::table('products')->insertGetId(['title' => $request->input('name'), 'description' => Product::formatToParagraphs($request->input('description')), 'category' => $category->id, 'seller_id' => Auth::user()->id, 'cost' => $request->input('cost')]);
        DB::table('product_files')->insert(['type' => 'main-img', 'path' => '/' . $url, 'product_id' => $product_id]);
        DB::table('product_files')->insert(['type' => 'card-img', 'path' => '/' . $url, 'product_id' => $product_id]);
        foreach ($sub_img as $item) {
            $url = ProductFile::SaveImg($item);
            DB::table('product_files')->insert(['type' => 'sub-img', 'path' => '/' . $url, 'product_id' => $product_id]);
        }
    }

    public static function DeleteProduct($id)
    {
        DB::table('products')->where('id', '=', $id)->update(['is_deleted' => 1]);
    }
}
