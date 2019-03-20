@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="col-md-12" style="padding:0.5cm;">
                    <span style="float:left;">
                        <h2> My Profile </h2>
                    </span>
                   <span style="float:right;">
                        <a href="/home"> Back to Dashboard</a>

                   </span>
                </div>

                <div class="col-md-12">
                    <div class="card" style="padding:1cm;margin-top:1cm;">
                        <form action="/profile" method="post">
                            {{ csrf_field() }}
                            @include('layouts.error')
                            @if(Auth::user()->hasprofile())
                            {{ method_field('PATCH') }}
                            @endif
                            <div class="form-group">
                                <label for="first_name">First name :</label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->first_name }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle name :</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->middle_name }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name :</label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->last_name }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone number :</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->phone_number }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="alternate_number">Alternate number :</label>
                                <input type="text" name="alternate_number" id="alternate_number" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->alternate_number }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="address">Address :</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->address }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="town">Town :</label>
                                <input type="text" name="town" id="town" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->town }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <label for="country">Country :</label>
                                <input type="text" name="country" id="country" class="form-control"
                                    @if($profile!=null)
                                        value='{{ $profile->country }}'
                                    @endif
                                >
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control btn-primary" value="Save">
                            </div>


                        </form>
                    </div>
                </div>
    </div>
@endsection
