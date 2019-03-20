<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $profile=auth()->user()->profile;
        if ($profile==null){
            //dd('null');
        }
        //dd($profile);
        return view('profile.index',compact('profile'));
    }

    public function store(){
        $this->validate(request(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required',

        ]);

        $profile= new Profile();

        $profile->user_id=auth()->user()->id;
        $profile->first_name=request('first_name');
        $profile->middle_name=request('middle_name');
        $profile->last_name=request('last_name');
        $profile->phone_number=request('phone_number');
        $profile->alternate_number=request('alternate_number');
        $profile->address=request('address');
        $profile->town=request('town');
        $profile->country=request('country');
        $profile->save();

        return back();
    }

    public function patch(){
        $this->validate(request(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required',

        ]);

        $profile= Profile::find(auth()->user()->profile->id);

        $profile->user_id=auth()->user()->id;
        $profile->first_name=request('first_name');
        $profile->middle_name=request('middle_name');
        $profile->last_name=request('last_name');
        $profile->phone_number=request('phone_number');
        $profile->alternate_number=request('alternate_number');
        $profile->address=request('address');
        $profile->town=request('town');
        $profile->country=request('country');
        $profile->save();

        return back();
    }


}
