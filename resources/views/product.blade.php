@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 80px 80px">
        <div class="row">
            <div class="col-4">
                <h1>{{$product[0]->title}}</h1>
                <h4>{{$product[0]->description}}</h4>
            </div>
            <div class="col-1"></div>
            <div class="col-4" style="margin-right: 20px;">

                <img class="product-main-image" src="{{asset('/img'.$product[0]->path)}}">
            </div>
            <div class="col-2">
                @for($i = 1; $i < count($product); $i++)
                    <div class="row">
                        <img class="product-sub-image" src="{{asset('/img'.$product[$i]->path)}}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
    </div>
@endsection

