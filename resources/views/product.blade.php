@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 80px 80px">
        <div class="row">
            <div class="col-4">
                <h1>{{$product->title}}</h1>
                <h4>{{$product->description}}</h4>
            </div>
            <div class="col-1"></div>
            <div class="col-4" style="margin-right: 20px;">

                <img class="product-main-image" src="{{asset('/img'.$product->path)}}">
            </div>
            <div class="col-2">
               <product-image-carousel :id="{{$product->product_id}}"></product-image-carousel>
            </div>
        </div>
    </div>
    </div>
@endsection

