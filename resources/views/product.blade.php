@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 80px 80px">
        @can('delete_product')
            <form method="post" action="/delete-product/{{$product->product_id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="submit" class="cancel" value="Delete" name="cancel"></input>
            </form>
        @endcan
        @auth()
                <form action="/add-appeal/{{$product->product_id}}" method="post">
                    @csrf
                    <input type="text" name="description">
                    <select name="appeal_type[]">
                        @foreach($appeals_type as $appeal_type)
                            <option value="{{$appeal_type->id}}">{{$appeal_type->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="">
                </form>
        @endauth
        <div class="row">
            <div class="col-4">
                <h1>{{$product->title}}</h1>
                <h4 style="word-wrap: break-word">{!! $product->description !!}</h4>
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
                <form action="/add-favorite/{{$product->product_id}}" method="post">
                    @csrf
                    <button class="like-btn">
                        <img src="{{asset('/img/empty-like.png')}}" alt="empty-like">
                    </button>
                </form>
                <div class="row">
                    <div class="col-6">
                        <h2>{{$product->cost}}$</h2>
                    </div>
                    <div class="col-6">
                        @auth()
                            <form method="post" action="/product/{{$product->product_id}}/buying">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name="seller" value="{{$product->seller_id}}">
                                <input type="submit" class="buying-btn" value="Buy">
                            </form>
                        @endauth
                        @if(!\Illuminate\Support\Facades\Auth::user())
                            <form method="get" action="/login">
                                <input type="submit" class="buying-btn" value="Buy">
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row buying-div-low">
                    <h4>{{$product->rating}}/5</h4>
                </div>
            </div>
        </div>
        <br>
        <h1>Reviews:</h1>
        <div class="col-6">
            @auth()
                <form action="/add-review/{{$product->product_id}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <textarea name="text" id="description" cols="50" rows="5" placeholder="Send review" required
                              style="margin-left: 15px"></textarea>
                    <br>
                    <input type="submit" class="cancel" value="Send" name="send"></input>
                </form>
            @endauth
            <review :id="{{$product->product_id}}"></review>
        </div>
    </div>
    </div>
@endsection

