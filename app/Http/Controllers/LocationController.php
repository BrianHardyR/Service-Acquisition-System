<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Servicelocation;
use App\Location;

class LocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('index','s_show');
    }

    public function store(){
        //dd(request('service_id'));
        $this->validate(request(),[
            'county'=>'required',
            'city'=>'required',
            'district'=>'required',
            'description'=>'required',
        ]);

        $location = new Location;
        $location->service_id=request('service_id');
        $location->lat=request('latitude');
        $location->lng=request('longitude');
        $location->county=request('county');
        $location->city=request('city');
        $location->district=request('district');
        $location->description=request('description');
        //dd($location);
        $location->save();

        return back();

    }

    public function delete(Location $location){
        $location->delete();
        return back();
    }

}
