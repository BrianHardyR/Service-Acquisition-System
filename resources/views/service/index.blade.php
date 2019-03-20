@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2> Services </h2>
            </span>
            <span style="float:right;">
                @auth
                    @if(Auth::user()->isprovider())
                        <a href="/service/my" class="btn btn-primary"> My Services </a>
                    @else
                        <a href="/service/create" class="btn btn-primary">Become Service Provider</a>
                    @endif
                @else
                    <a href="/">back</a>
                @endauth
            </span>
        </div>

        <search-service>search</search-service>

        <div class="col-md-12" style="padding:0.5cm;">
            <div class="card" style="padding:0.5cm">
                Here are some services to start you off :
                @foreach($services as $service)
                    <div class="card" style="padding:5px;">
                        <a href="/service/search/{{ $service->id }}">
                            <div>
                                <p>{{ $service->name }} at {{ $service->ask_price }} /=</p>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
</div>
@endsection
