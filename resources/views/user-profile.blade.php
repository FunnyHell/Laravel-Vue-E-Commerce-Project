@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 menu">
                <div class="row">
                    <h2>Hello, {{Auth::user()->name}}</h2>
                </div>
                <hr>
                <div class="row">
                    <button class="menu-but active">History</button>
                    <button class="menu-but">Setting</button>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
@endsection
