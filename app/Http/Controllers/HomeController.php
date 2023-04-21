<?php

namespace App\Http\Controllers;

use App\Models\BuyingHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->route('admin-profile');
                break;
            case 'seller':
                return redirect()->route('seller-profile');
                break;
            case 'user':
                return redirect()->route('user-profile');
                break;
        }
    }

    public function adminProfile()
    {
        return view('admin-profile');
    }

    public function sellerProfile()
    {
        return view('seller-profile');
    }

    public function sellerStatistic()
    {
        return view('seller-statistic');
    }

    public function GetStatistic($id){
        return User::GetStatistic($id);
    }

    public function userProfile()
    {
        return view('user-profile');
    }
}
