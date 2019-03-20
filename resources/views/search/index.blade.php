@extends('layouts.start')

@section('content')
        <div style="" class="">
            <div style="background:red;height:100%;width:100%;z-index:-1;position:fixed;">
                <div id="app">
                <my-map></my-map>
                </div>
            </div>

            <div class="flex-center position-ref full-height" style="">

                @if (Route::has('login'))
                    <div class="top-right links" style="background-color:snow;">
                            <a href="/">Welcome</a>
                        @auth
                            <a href="{{ url('/home') }}">Dashboard</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                @endif

                <div class="content" style="width:60%;
                                            background-color:rgba(0,0,0,0.5);
                                            padding:0.3cm;
                                            margin-top:-10%;
                                            ">

                    <search-all></search-all>

                </div>

            </div>

        </div>
@endsection
