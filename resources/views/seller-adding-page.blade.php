@extends('layouts.app')
@section('content')
    <div class="container" style="height: 50vh">
        <div class="row">
            @include('layouts.seller.seller-menu')
            <div class="col-6">
                <form action="/seller/{{Auth::user()->id}}/add-new" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="text" name="name" id="name" placeholder="name of product" class="input-text" required>
                    <input type="number" name="cost" id="cost" placeholder="cost of product" class="input-text" required>
                    <br>
                    <textarea name="description" id="description" cols="61" rows="5" placeholder="description" required></textarea>
                    <br>
                    <select name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{$category->name}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <input type="file" name="main-img" id="main-img" accept="image/*" class="input-file" required>
                    <input type="file" name="sub-img[]" id="sub-img" accept="image/*" class="input-file" multiple required>
                    <br>
                    <input type="submit" value="Add" id="send" class="input-btn">
                    <input type="reset" value="Reset" id="reset" class="input-btn">
                </form>
            </div>
        </div>
    </div>
@endsection
