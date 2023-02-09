@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 80px 80px">
        <div class="row">
            <div class="col-3">
                <h1>{{$product->title}}</h1>
                <h4>{{$product->description}}</h4>
            </div>
            <div class="col-1"></div>
            <div class="col-4">
                
            </div>
        </div>
    </div>
@endsection
