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

                <div class="content" style="background-color:rgba(0,0,0,0.5);padding:1cm;color:white;">

                    <div class="title m-b-md" style="">
                        SAS
                    </div>
                    <div style="margin-top:-50px;">
                        <h5><p> welcome to the </p>
                        service acquisition system
                        </h5>

                    </div>
                    <div style="margin-top:50px">
                        <a href="/search" class="btn btn-primary"> Search </a>
                        <a href="/service" class="btn btn-primary"> Services </a>
                    </div>

                </div>

            </div>

        </div>
@endsection
