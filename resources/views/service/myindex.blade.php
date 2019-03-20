@extends('layouts.app')

@section('content')
<div class="container">

    <div class="">

        <div class="col-md-12" style="padding:0.5cm;">
            <span style="float:left;">
                <h2>My Services </h2>
            </span>
            <span style="float:right;">
                    <a href="/provider" class="btn btn-primary"> Provider Dashboard  @if(Auth::user()->notify()!='')({{ Auth::user()->notify() }})@endif</a>
               <a href="/home">Back to Dashboard </a>
            </span>
        </div>

        <div class="card" style='margin:1cm;'>

            <div class="card-header" style='height:1cm;'>Services</div>

            <div class="card-body">
                @foreach($services as $service)
                    <div class="card" style=''>
                            <div class="card-header" style=''>
                                {{ $service->name }}
                                <span style="float:right">
                                    <span style="margin-right:0.5cm">
                                    <a href="/service/{{ $service->id }}" class="btn btn-primary">Edit</a>
                                    </span>
                                    <span style="float:right;">
                                    <a href="/service/destroy/{{ $service->id }}" class="btn btn-primary">Delete</a>
                                    </span>
                                </span>
                            </div>
                            <div class="card-body">

                                <p>{{ $service->description }}</p>
                                <div class='card' style="padding:0.2cm;">
                                    <p>
                                        Service Locations : {{ $count=$service->locations->count() }}

                                    </p>
                                    @if($count==0)
                                        <div class="alert alert-info" style="">
                                            this service will not be available in search until you add its location. you can do that<a href="/service/{{ $service->id }}"> here </a>
                                        </div>
                                    @endif
                                </div>

                            </div>

                    </div>
                    @endforeach

            </div>
            <div class="card-footer">

                <a href="/service/create">+ new service </a>

            </div>

        </div>


    </div>
</div>
@endsection
