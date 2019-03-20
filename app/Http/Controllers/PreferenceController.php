<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preference;
use App\Service;

class PreferenceController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Service $service){


        $preference = new Preference();

        $preference->user_id=auth()->user()->id;
        $preference->service_id=$service->id;

        $preference->save();


        return back();

    }

    public function destroy(Service $service){
        $preference = Preference::all()->where('service_id',$service->id)->first();

        $preference->delete();

        return back();
    }

    public function complete(Service $service){

    }
}
