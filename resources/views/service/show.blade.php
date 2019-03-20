@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-12" style="padding:0.5cm;">
                <span style="float:left;">
                    <h2> {{ $service->name }} </h2>
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
                    @if($provider->profile!=null)
                    <a href="/provider/{{ $provider->id }}">
                        @endif
                        Provider :{{ $provider->name }}
                    </a>
                    <br>

                    Completed requests : {{ $service->completerequests->count() }}
                    <hr>
                    @if($request==null)
                        <a href="/request/{{ $service->id }}" class=" btn btn-primary">Request Service</a>
                    @else
                        @if($request->ispending()==false)
                            <a href="/request/show/{{ $request->id }}" class=" btn btn-primary">Complete</a>
                        @endif
                        <a href="/request/destroy/{{ $request->id }}" class=" btn btn-primary" style="margin-top:0.2cm;">Cancel</a>
                    @endif
                    @if($preference==false)
                        <a href="/preference/{{ $service->id }}" class="btn btn-primary" style="margin-top:0.2cm;">Add to Preferences</a>
                    @else
                        <a href="/preference/destroy/{{ $service->id }}" class="btn btn-primary" style="margin-top:0.2cm;">Remove from Preferences</a>

                    @endif

                </div>
            </span>
        </span>
    </div>
    <div class="card" style="margin-top:0.5cm;padding:10px;">
        Feedback: {{ $service->feedback->count() }}
        @foreach($service->feedback as $feedback)
            <div class="card" style="padding:10px;">

                {{ $feedback->comment }}

                <span style="float:right">
                    commented by: {{ $feedback->user->name }}
                    {{ $feedback->created_at->diffForHumans() }}
                    <hr>
                </span>
            </div>
        @endforeach
    </div>
</div>
@endsection
