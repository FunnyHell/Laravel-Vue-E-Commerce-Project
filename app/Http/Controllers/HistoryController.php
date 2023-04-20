<?php

namespace App\Http\Controllers;

use App\Models\BuyingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Support\Collection
     */

    public function GetHistory($id){
        return BuyingHistory::GetHistory($id);
    }
}
