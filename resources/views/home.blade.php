@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2> Dashboard </h2>
            </span>
           <span style="float:right;">
            @if(Auth::user()->isprovider())
                <a href="/provider" class="btn btn-primary"> Provider Dashboard  @if(Auth::user()->notify()!='')({{ Auth::user()->notify() }})@endif</a>
                <a href="/service/my" class="btn btn-primary"> My Services </a>
            @else
                <a href="/service/create" class="btn btn-primary">Become Service Provider</a>
            @endif
           </span>
        </div>
        @if(Auth::user()->profile==null)
        <div class="alert alert-info">
            Remember to fill out your profile. you can do that<a href="/profile"> here</a>
        </div>
        @endif
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header" style="height:1cm;">
                    <span>
                    Notification
                    <span style="float:right">
                       <a href="/message"> Message History</a>
                    </span>
                    </span>
                </div>

                <div class="card-body">
                    <div style="display:none">{{ $count=0 }}</div>
                    @foreach(Auth()->user()->unread() as $msg)
                    <div style="display:none">{{ $count=$count+1 }}</div>
                        <span>
                        {{ $msg->message }}
                            <span style="float:right">
                                <a href='/message/{{ $msg->id }}'>dismiss</a>
                            </span>
                        </span>
                        <hr>
                    @endforeach
                    @if($count==0)
                        You have no unread notification messages
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card" style="margin-top:0.5cm;">
                <span>

                    <div class="card-header" style="height:1cm;">
                        My requests

                        <span style="float:right">
                            <a href="/request">History</a>
                        </span>
                    </div>


                </span>

                <div class="card-body">

                    @foreach(Auth::user()->incompleterequests as $request)

                    <span style="margin:0.5cm;">
                        <span style="float:left;">
                            {{ $request->service->name }} by {{ $request->service->provider()->name }}
                        </span>
                        <span style="float:right;">

                            @if($request->ispending()==false)
                                <a href="/request/show/{{ $request->id }}" class=" btn btn-primary">Complete</a>
                             @endif
                                <a href="/request/destroy/{{ $request->id }}" class=" btn btn-primary" style="">Cancel</a>

                        </span>

                    </span>
                    <hr>

                    @endforeach


                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card" style="margin-top:0.5cm;">
                <div class="card-header" style="height:1cm;">My preferences</div>
                <div style="display:none">{{ $count=0 }}</div>
                <div class="card-body">
                    @foreach(Auth::user()->preference as $preference)
                    <div style="display:none">{{ $count=$count+1 }}</div>
                    <div class="card" style="padding:0.3cm;">
                        <span style="float:left;">
                                <a href="/service/search/{{$preference->service->id}}">{{ $preference->service->name }} by {{ $preference->service->provider()->name }} </a>
                        </span>
                        <span style="float:right;">


                        </span>
                    </div>

                    @endforeach
                    @if($count==0)
                        You do not have any prefered services
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
