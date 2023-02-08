<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    static public function GetCategories()
    {
        $data = DB::table('categories')
            ->orderByRaw('IFNULL(parent_id, id), parent_id, id')
            ->get();
        return response()->json($data);
    }
}
