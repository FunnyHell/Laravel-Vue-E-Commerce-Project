@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h2 style="margin-left: 20px">Hello, {{Auth::user()->name}}</h2>
                <a href="/user"><button class="cancel side-btn">Buying history</button></a>
            </div>
            <div class="col-6">
                @foreach($favorites as $favorite)
                    <div class="product-container">
                        <a href="/product/{{$favorite->id}}">
                            <img src="/storage/{{$favorite->path}}" class="product-image">
                            <div class="product">
                                <div class="text-container">
                                    <span>
                                        <h2>{{ $favorite->title }}</h2>
                                        <h2>{{ $favorite->cost }}$</h2>
                                    </span>
                                    <span>
                                        <h3>{{ $favorite->rating }}/10</h3>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <form action="/delete-favorite/{{$favorite->id}}" method="post">
                            @csrf
                            <input type="submit" class="cancel" value="Delete" name="delete"/>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
