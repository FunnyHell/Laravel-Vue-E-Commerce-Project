<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuyingHistory extends Model
{
    use HasFactory;

    static public function GetHistory($id)
    {
        $sellers_arr = DB::table('buying_histories')->where('costumer_id', $id)->get('seller_id')->toArray();
        $products_arr = DB::table('buying_histories')->where('costumer_id', $id)->get('product_id')->toArray();
        $s_arr = array();
        foreach ($sellers_arr as $item) {
            array_push($s_arr, $item->seller_id);
        }
        $p_arr = array();
        foreach ($products_arr as $item) {
            array_push($p_arr, $item->product_id);
        }
        $tmp = collect();
        $size = sizeof($s_arr);
        for ($i = 0; $i < $size; $i++) {
            $tmp->push(DB::table('products')->where('products.id', $p_arr[$i])
                ->join('product_files', function ($join) {
                    $join->on('products.id', '=', 'product_files.product_id')
                        ->where('product_files.type', '=', 'card-img');
                })
                ->leftJoin('users', function ($join) {
                    $join->on('users.id', '=', 'products.seller_id');
                })
                ->select('products.*', 'product_files.path', 'users.name')
                ->get());
        }
        $db = collect();
        foreach ($tmp as $item) {
            $db->push($item[0]);
        }
        dd($db);
        return $db;
    }
}
