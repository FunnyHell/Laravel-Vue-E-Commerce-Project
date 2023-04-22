@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.seller.seller-menu')
            <div class="col-4">
                @for($i = 1; $i <= count($products['months']); $i++)
                    <hr>
                    <h1 style="text-align: center">{{$products['months'][$i]}}</h1>
                    @if($products['db']->has($i))
                        @foreach($products['db'][$i] as $product)
                            <div class="product-container">
                                <img src="{{asset('storage/'.$product->path)}}" class="product-image">
                                <div class="product">
                                    <div class="text-container" style="height: 70px">
                                        <span>
                                            <h2>{{ $product->title }}</h2>
                                            <h2>{{ $product->cost }}$</h2>
                                        </span>
                                        <span>
                                            <h3>{{ $product->rating }}/10</h3>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endfor
            </div>
            <div class="col-3" style="margin-left: 50px;">
                <h1>Info for year</h1>
                @foreach(array_keys($products['count']) as $item)
                    <h2>Product {{$products['products_names'][$item]}}</h2>
                    <h3>Was sold {{$products['count'][$item]}} times for year</h3>
                    <h2>By months</h2>
                    <div class="product-container" style="padding-top: 10px">
                        @foreach(array_keys($products['total_cost'][$item]) as $i)
                            <h4>{{ $products['months'][$i] }} : {{$products['total_cost'][$item][$i]}}$</h4>
                        @endforeach
                    </div>
                    <h3>Total: {{$products['costs'][$item]}}$</h3>
                    <hr>
                @endforeach
                <h2>Total for year: {{$products['total']}}$</h2>
            </div>
        </div>
    </div>
@endsection
