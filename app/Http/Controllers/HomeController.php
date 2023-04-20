<?php

namespace App\Http\Controllers;

use App\Models\BuyingHistory;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminProfile()
    {
        return view('admin-profile');
    }

    public function sellerProfile()
    {
        return view('seller-profile');
    }

    public function userProfile()
    {
        return view('user-profile');
    }

    public function GetSettings($id)
    {
        return User::GetSettings($id);
    }
}
