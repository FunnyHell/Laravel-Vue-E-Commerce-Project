<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductFile extends Model
{
    use HasFactory;

    static public function GetImages($id){
        $data = DB::table('product_files')
            ->where('product_id','=',$id)
            ->where('type','=','sub-img')
            ->get();
        return response()->json($data);
    }
}
