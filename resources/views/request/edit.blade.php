@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-left">

        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2> Request </h2>
            </span>
            <span style="float:right;">

                <a href="/home"> Back to Dashboard</a>
            </span>
        </div>

        <div class="card col-md-12">
                <span style="padding:10px;">
                    <span class='' style="float:left;width:50%">
                        <div class="card" style="width:100%;height:100%;padding:10px;">
                            <h3>{{ $service->name }}</h3>
                            <p>{{ $service->description }}</p>
                            {{ $service->ask_price }} Kshs
                        </div>
                    </span>
                    <span style="float:right;width:50%;height:100%" >
                        <div class="card" style="width:100%;height:100%;padding:10px;margin-left:0.1cm">
                            Provider :{{ $provider->name }}
                            <hr>
                            Status : {{ $request->status }}
                            <br>
                            Requested {{ $request->created_at->diffForHumans() }} at {{ $request->created_at->toDateTimeString() }}

                        </div>
                    </span>
                </span>
            </div>
            @if($request->status!='complete')
                <div class="card  col-md-12" style="padding:1cm;margin-top:0.5cm;" id="complete_form">

                    <form action="/request/complete" method="post">
                        {{ csrf_field() }}
                        @include('layouts.error')
                        <input type="hidden" name="id" id="id" value="{{ $request->id }}">
                        <div class="form-group">
                            <label for="finish_price">What were you charged ? :</label>
                            <input type="text" name="finish_price" id="finish_price" class="form-control" placeholder="finish price">
                        </div>
                        <div class="form-group">
                            <label for="name">Please Leave a Comment ? :</label>
                            <textarea name='feedback' id="feedback" class="form-control" placeholder="comment"></textarea>
                        </div>

                        <input type="submit" value="complete" class="btn btn-primary">
                    </form>

                </div>
            @endif


    </div>
</div>
@endsection
