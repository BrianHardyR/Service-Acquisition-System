@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12" style="padding:0.5cm;">
        <span style="float:left;">
            <h2> Request history </h2>
        </span>
        <span style="float:right;">

            <a href="/home"> Back to Dashboard</a>
        </span>
    </div>
    <div class="card col-md-12" style="padding:1cm;">

        @foreach($requests as $request)
            <div class="card" style="margin:0.2cm;padding:0.2cm;">

                {{ $request->service->name }} {{ $request->created_at->diffForHumans() }} by {{ $request->service->provider()->name }}
                <br>
                <span style="margin-left:2cm;">
                    Status : {{ $request->status }}
                    <br>
                    @if($request->iscomplete())
                        <div class="card" style="padding 0.5cm;">
                            Completed {{ $request->updated_at->diffForHumans() }}
                        </div>
                    @endif

                </span>
                <span style="float:right">
                    <a href="/request/show/{{ $request->id }}"> View Request </a>
                    <a href="/service/search/{{ $request->service->id }}"> View Service </a>
                </span>
            </div>
        @endforeach

    </div>
</div>

@endsection
