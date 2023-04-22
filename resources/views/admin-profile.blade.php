@extends('layouts.app')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        @foreach($appeals as $appeal)
            <div class="row appeal">
                <div class="col">
                    <h3>Appeal №{{$appeal->id}}</h3>
                    <h4>by {{$appeal->user_name}}</h4>
                </div>
                <div class="col">
                    <h3>Type of appeal: {{$appeal->appeal_type_name}}</h3>
                    <h3>Description: {{$appeal->description}}</h3>
                </div>
                <div class="col">
                    <form method="post" action="/cancel-appeal/{{$appeal->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="submit" class="cancel" value="Cancel" name="cancel"></input>
                    </form>
                    <br>
                    <form method="post" action="/delete-appeal/{{$appeal->id}}">
                        <input type="hidden" name="product_id" value="{{$appeal->product_id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="submit" class="cancel" value="Delete" name="delete"></input>
                    </form>
                </div>
                <div class="col">
                    <h3>Product: <a href="/product/{{$appeal->product_id}}">{{$appeal->title}}</a></h3>
                </div>
            </div>
        @endforeach
    </div>
@endsection
