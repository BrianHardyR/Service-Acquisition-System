@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-12" style="padding:0.5cm;">
                        <span style="float:left;">
                            <h1> {{ $user->name }} </h1>
                            <h4>{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h4>
                        </span>
                        <span style="float:right">
                            Contact 1 : {{ $user->profile->phone_number }}<br>
                            Contact 2 : {{ $user->profile->alternate_number }}<br>
                            email     : {{ $user->email }}<br>
                        </span>
                </div>
                Services I offer:
                <div class="col-md-12 card" style="padding:0.5cm;margin-top:0.5cm;">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Asking Price</th>
                        <th scope="col">Locations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div style="display:none">{{ $count=0 }}</div>
                        @foreach($user->services as $service)

                            <tr>

                            <th scope="row">{{ $count=$count+1 }}</th>
                            <td>
                            <a href='/service/search/{{ $service->id }}'>
                                {{ $service->name}}
                            </a>
                            </td>
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->ask_price }}/=</td>
                            <td>
                                @if($service->locations->count()==0)
                                        Not Available
                                @endif
                                @foreach($service->locations as $location)
                                    {{ $location->description }} /

                                @endforeach
                            </td>

                            </tr>

                        @endforeach
                    </tbody>
                    </table>
                </div>

        </div>

</div>
@endsection
