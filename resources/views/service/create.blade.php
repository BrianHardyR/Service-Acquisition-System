@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-left">

        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2> New Service </h2>
            </span>
            <span style="float:right;">
                @if(Auth::user()->isprovider())
                    <a href="/service" class="btn btn-primary"> My Services </a>
                @else

                @endif
                <a href="/home"> Back to Dashboard</a>
            </span>
        </div>

        <div class="col-md-12 card" style="padding:1cm;">
            @if(!Auth::user()->isprovider())
            <div class="alert alert-warning">
                <ul>
                    <li>   Becoming a provider will make your profile public and will be found by search</li>
                    <li>   Remember to add service location after your done here </li>
                </ul>
            </div>
            @endif
            <form action="/service/create" method="post">
                @include('layouts.error')
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Title :</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea type="text" name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="ask_price">Asking price :</label>
                    <input type="text" name="ask_price" id="ask_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ask_price">Type :</label>
                    <input type="text" name="type" id="type" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ask_price">Sub Type :</label>
                    <input type="text" name="sub_type" id="sub_type" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>


    </div>
</div>
@endsection
