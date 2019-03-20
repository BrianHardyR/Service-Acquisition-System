@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="padding:0.5cm;">
                <span style="float:left;">
                    <h2> Message history </h2>
                </span>
            <span style="float:right;">
                    <a href="/home"> back to dashboard </a>
            </span>
            </div>
            <div class="col-md-12" style="padding:0.5cm;">

                @if($unread->count()>0)
                <div class="card" style="">
                    <div class="card-header">
                        Unread Messages : {{ $unread->count() }}
                    </div>
                    <div class="card-body">
                    @foreach($unread as $msg)
                        {{ $msg->message }}
                    @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-12" style="padding:0.5cm;">

                @if($read->count()>0)
                    <div class="card" style="">
                        <div class="card-header">
                            Read Messages
                        </div>
                        <div class="card-body">

                        @foreach($read as $msg)
                        <div>
                            {{ $msg->message }}
                            <span style="float:right">
                               <a href="/message/destroy/{{ $msg->id }}"> delete</a>
                            </span>

                        </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                @endif
                </div>
                <div class="col-md-12" style="padding:0.5cm;">

                @if($sent->count()>0)
                    <div class="card" style="">
                        <div class="card-header">
                            Sent Messages
                        </div>
                        <div class="card-body">

                        @foreach($sent as $msg)
                        <div>
                            {{ $msg->message }}
                            <span style="float:right">
                               <a href="/message/destroy/{{ $msg->id }}"> delete</a>
                            </span>

                        </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                @endif
                </div>
        </div>
    </div>

@endsection
