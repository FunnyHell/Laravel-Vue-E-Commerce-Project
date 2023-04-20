@extends('layouts.app')
@section('content')
    <style>
        #history {
            display: block;
        }

        #setting {
            display: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-3 menu">
                <div class="row">
                    <h2>Hello, {{Auth::user()->name}}</h2>
                </div>
                <hr>
                <div class="row">
                    <button class="menu-but" onclick="toggleVisibility()">History</button>
                    <button class="menu-but" onclick="toggleVisibility()">Setting</button>
                </div>
            </div>
            <div class="col-6">
                <buying-history :id="{{Auth::user()->id}}" id="history"></buying-history>
                <setting :id="{{Auth::user()->id}}" id="setting"></setting>

            </div>
        </div>
    </div>
    <script>
        function toggleVisibility(){
            var history = document.getElementById('history');
            var setting = document.getElementById('setting');
            if (history.style.display === 'block'){
                history.style.display = 'none';
                setting.style.display = 'block';
            } else {
                history.style.display = 'block';
                setting.style.display = 'none';
            }
        }
    </script>
@endsection
