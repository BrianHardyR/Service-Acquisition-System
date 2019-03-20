@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12" style="padding:0.5cm;">
            <span>
            <span style="float:left;">
                <h2> Provider Dashboard </h2>
            </span>
            <span style="float:right;margin-bottom:1cm;">

                <a href="/service/my" class="btn btn-primary"> My Services </a>
                <a href="/home"> back to Dashboard </a>

            </span>
            </span>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="height:1cm;">
                    Quick Response <div style="display:none"> {{ $count=0 }}</div>
                </div>

                <div class="card-body">

                    @foreach(Auth::user()->services as $service)
                        @foreach($service->pendingrequests as $request)
                        <div style="display:none">{{ $count=$count+1 }}</div>
                        <span>
                            {{ $service->name }} service for {{ $request->user->name }} requested {{ $request->created_at->diffForHumans() }}
                            <span style="float:right">
                                <form action="/request/accept" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $request->id }}" id="id" name="id">
                                    @if(!Auth::user()->busy())
                                        <input type="submit" value="Accept" class="btn btn-primary">
                                    @endif
                                    <a href="/request/destroy/{{ $request->id }}" class="btn btn-primary"> Reject </a>
                                </form>

                            </span>
                        </span>
                            <hr>
                        @endforeach
                    @endforeach
                    @if($count==0)
                        you do not have any pending requests
                    @endif
                </div>
                @if(Auth::user()->busy() && $count!=0)
                <div class="card-footer">
                    you may accept another service request once you are done with the other one
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-12" style="margin-top:1cm;">
            <div class="card">
                <div class="card-header" style="1cm;">
                    Requests to work on <div style="display:none"> {{ $count=0 }}</div>
                </div>

                <div class="card-body">

                    @foreach(Auth::user()->services as $service)
                        @foreach($service->acceptedrequests as $request)
                        <div style="display:none">{{ $count=$count+1 }}</div>
                        <span>
                            {{ $service->name }} service for {{ $request->user->name }} requested {{ $request->created_at->diffForHumans() }}
                            <span style="float:right">

                                <form action="/request/cancel" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="id" name="id" value="{{ $request->id }}">
                                    <input type="submit" class="btn btn-primary" value="Cancel">
                                </form>


                            </span>
                        </span>
                            <hr>
                        @endforeach
                    @endforeach
                    @if($count==0)
                        you do not have any active service requests
                    @endif
                </div>

            </div>
        </div>
        </div>

</div>

@endsection
