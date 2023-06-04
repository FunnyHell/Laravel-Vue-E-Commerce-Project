<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Appeal extends Model
{
    use HasFactory;

    public static function AddAppeal($request, $id){
        DB::table('appeals')->insert([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'type_id' => $request->appeal_type[0],
            'description' => $request->description,
        ]);
    }

    public static function GetAppeals()
    {
        return DB::table('appeals')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'appeals.user_id');
            })
            ->leftJoin('appeal_types', function ($join) {
                $join->on('appeal_types.id', '=', 'appeals.type_id');
            })
            ->leftJoin('products', function ($join) {
                $join->on('products.id', '=', 'appeals.product_id');
            })
            ->select('appeals.*', 'products.title', 'appeal_types.name AS appeal_type_name', 'users.name AS user_name')
            ->where('appeals.result', '=', NULL)
            ->groupBy('appeals.id', 'products.id', 'appeal_type_name', 'user_name')
            ->get();
    }

    public static function Cancel($id)
    {
        DB::table('appeals')
            ->where('id', '=', $id)
            ->update(['admin_id' => Auth::user()->id, 'result' => 'cancelled']);
    }

    public static function DeleteByAppeal($id, $product_id)
    {
        DB::table('products')
            ->where('id', '=', $product_id)
            ->update(['is_deleted' => 1]);
        DB::table('appeals')
            ->where('id', '=', $id)
            ->update(['admin_id' => Auth::user()->id, 'result' => 'deleted']);
    }

    public static function GetAppealsType(){
        return DB::table('appeal_types')->get();
    }
}
