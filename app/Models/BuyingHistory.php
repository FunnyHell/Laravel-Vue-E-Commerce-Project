<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BuyingHistory extends Model
{
    use HasFactory;

    static public function GetProducts($id)
    {
        $months = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];

        //Получаем идентификаторы товаров и записей о продаже
        $sellers_arr = DB::table('buying_histories')->where('seller_id', $id)->get('seller_id')->toArray();
        $products_arr = DB::table('buying_histories')->where('seller_id', $id)->get('product_id')->toArray();
        $s_arr = array();
        foreach ($sellers_arr as $item) {
            array_push($s_arr, $item->seller_id);
        }
        $p_arr = array();
        foreach ($products_arr as $item) {
            array_push($p_arr, $item->product_id);
        }

        //Получаем данные о товарах, которые были проданны
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
                ->leftJoin('buying_histories', function ($join) use ($i) {
                    $join->on('buying_histories.product_id', '=', 'products.id')
                        ->where('buying_histories.id', '=', $i + 1);
                })
                ->select('products.*', 'product_files.path', 'users.name', 'buying_histories.created_at')
                ->get());
        }

        $db = collect();
        $count = array();
        $cost = array(); // массив для хранения суммы за каждый товар и месяц
        foreach ($tmp as $item) {
            $db->push($item[0]);
            if (isset($count[$item[0]->id])) {
                $count[$item[0]->id] += 1;
            } else {
                $count[$item[0]->id] = 1;
            }
            $month = Carbon::parse($item[0]->created_at)->month;
            if (isset($cost[$item[0]->id][$month])) {
                $cost[$item[0]->id][$month] += $item[0]->cost;
                $cost[$month][$item[0]->id] += $item[0]->cost;
            } else {
                $cost[$item[0]->id][$month] = $item[0]->cost;
                $cost[$month][$item[0]->id] = $item[0]->cost;
            }
        }


        $product_names = array();
        foreach (array_keys($count) as $item){
            $product_names[$item] = DB::table('products')->where('id', '=', $item)->get('title')[0]->title;
        }

        $costs = array(); //Получаем данные по товарам без группировки по месяцам
        foreach ($count as $key => $value) {
            $costs[$key] = $value * DB::table('products')->where('id', $key)->value('cost');
        }

        $groupedProducts = $db->groupBy(function ($product) { //Записываем товары, группируя их по месяцам
            $createdAt = Carbon::parse($product->created_at);
            return $createdAt->month;
        });

        $total = 0;
        foreach ($costs as $c) {
            $total += $c;
        }

        return ['db' => $groupedProducts, 'count' => $count, 'total_cost' => $cost, 'costs' => $costs, 'months' => $months, 'products_names' => $product_names, 'total' => $total];
    }

    static public function GetHistory($id) // получаем все продукты покупателя
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
        return $db;
    }

    public static function AddNew($request, $id)
    {
        DB::table('buying_histories')
            ->insert(['product_id'=>$id, 'seller_id'=>(int)$request->input('seller'), 'costumer_id'=>Auth::user()->id]);
        return 1;
    }
}
