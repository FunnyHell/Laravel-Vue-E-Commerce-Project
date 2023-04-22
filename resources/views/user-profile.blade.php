@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h2 style="margin-left: 20px">Hello, {{Auth::user()->name}}</h2>
            </div>
            <div class="col-6">
                <buying-history :id="{{Auth::user()->id}}" :csrf="'{{csrf_token()}}'" id="history"></buying-history>
            </div>
        </div>
    </div>
@endsection
