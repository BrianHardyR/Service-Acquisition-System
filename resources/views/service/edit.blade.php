@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2> {{ $service->name }} </h2>
            </span>
            <span style="float:right;">
                @auth
                    @if(Auth::user()->isprovider())
                        <a href="/service/my" class="btn btn-primary"> My Services </a>
                    @else
                        <a href="/service/create" class="btn btn-primary">Become Service Provider</a>
                    @endif
                    <a href="/home"> Back to Dashboard</a>
                @else
                    <a href="/">back</a>
                @endauth
            </span>
        </div>

        <div class="col-md-12 card" style="padding:1cm;">
            <form action="/service/create" method="post">
                @include('layouts.error')
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <input type="hidden" name="id" id="id" value="{{ $service->id }}">
                <div class="form-group">
                    <label for="name">Title :</label>
                    <input type="text" name="name" id="name" class="form-control" value='{{ $service->name }}'>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea type="text" name="description" id="description" class="form-control">{{ $service->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="ask_price">Asking price :</label>
                    <input type="text" name="ask_price" id="ask_price" class="form-control" value="{{ $service->ask_price }}">
                </div>
                <div class="form-group">
                    <label for="ask_price">Type :</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ $service->type }}">
                </div>
                <div class="form-group">
                    <label for="ask_price">Sub Type :</label>
                    <input type="text" name="sub_type" id="sub_type" class="form-control" value="{{ $service->sub_type }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn-primary" value="Update">
                </div>
            </form>
        </div>

        <div class="col-md-12 card" style="padding:1cm;margin-top:0.5cm;">
            <div class="card" style="padding:1cm;">
                <div style="display:none">{{ $count=0 }}</div>
                Service Locations:
                <table class="table table-striped" style="margin-top:0.6cm;">
                        <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">County</th>
                                <th scope="col">City</th>
                                <th scope="col">District</th>
                                <th scope="col">Description</th>
                                </tr>
                            </thead>
                @foreach($service->locations as $location)
                    <div style="display:none">{{ $count=$count+1 }}</div>


                        <tbody>
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <td>{{ $location->county }}</td>
                                <td>{{ $location->city }}</td>
                                <td>{{ $location->district }}</td>
                                <td>{{ $location->description }}
                                    <a href="/location/destroy/{{ $location->id }}" class="btn"> remove </a>
                                </td>


                            </tr>
                        </tbody>

                @endforeach
                </table>
                @if($count==0)
                    You have not set a location for your service
                @endif
            </div>
            <div class="card" style="margin-top:1cm;">
            <span>
                <form action="/location/store" method="post">
                    @include('layouts.error')
                    {{ csrf_field() }}
                    <input type="hidden" id="service_id" name="service_id" value="{{ $service->id }}">
                    <my-place ></my-place>
                </form>
            </span>
            </div>
        </div>


    </div>
</div>
@endsection
