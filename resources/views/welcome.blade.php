<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

</head>


@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container" style="padding: 0 80px">
            <product-list></product-list>
        </div>
    </div>
@endsection

