@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 80px 80px">
        @can('delete_product')
            <form method="post" action="/delete-product/{{$product->product_id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="submit" class="cancel" value="Delete" name="cancel"></input>
            </form>
        @endcan
        <div class="row">
            <div class="col-4">
                <h1>{{$product->title}}</h1>
                <h4 style="word-wrap: break-word">{{$product->description}}</h4>
            </div>
            <div class="col-1"></div>
            <div class="col-4" style="margin-right: 20px;">
                <img class="product-main-image" src="{{asset('storage/'.$product->path)}}">
            </div>
            <div class="col-2">
                <product-image-carousel :id="{{$product->product_id}}"></product-image-carousel>
            </div>
        </div>
        <div class="row" style="margin-top: 23px">
            <div class="col-4">
                <h1>Recommend</h1>
                <recommendation-products :id="{{$product->product_id}}"></recommendation-products>
            </div>
            <div class="col-1"></div>
            <div class="col-2 buying-div">
                <button class="like-btn">
                    <img src="{{asset('/img/empty-like.png')}}" alt="empty-like">
                </button>
                <div class="row">
                    <div class="col-6">
                        <h2>{{$product->cost}}$</h2>
                    </div>
                    <div class="col-6">
                        <form>
                            @csrf
                            <input type="submit" class="buying-btn" value="Buy">
                        </form>
                    </div>
                </div>
                <div class="row buying-div-low">
                    @if (isset($product->promotion))
                        <h4>{{$product->promotion}}$</h4>
                    @endif
                    <h4>{{$product->rating}}/5</h4>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

