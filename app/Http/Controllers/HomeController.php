<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function __invoke()
    {

    }

    public function adminProfile()
    {
        return view('admin');
    }

    public function sellerProfile()
    {
        return view('seller');
    }

    public function userProfile()
    {
        return view('user');
    }
}
