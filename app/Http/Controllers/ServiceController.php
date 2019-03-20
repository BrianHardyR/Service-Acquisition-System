<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\User;

class ServiceController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth')->except('index','s_show');
    }

    public function index(){
        $services=Service::all()->take(10);

        return view('service.index',compact('services'));

    }

    public function provider(){
        $services=auth()->user()->services;
        return view('service.myindex',compact('services'));
    }

    public function create(){
        return view('service.create');
    }

    public function store(){

        $this->validate(request(),[
            'name'=>'required',
            'description'=>'required',
            'ask_price'=>'required',
            'type'=>'required',
            'sub_type'=>'required',

        ]);

        $service= new Service;

        $service->name=request('name');
        $service->description=request('description');
        $service->ask_price=request('ask_price');
        $service->type=request('type');
        $service->sub_type=request('sub_type');
        $service->user_id=auth()->user()->id;

        $service->save();

        return redirect('/service/my');

    }

    public function update(){

        $this->validate(request(),[
            'name'=>'required',
            'description'=>'required',
            'ask_price'=>'required',
            'type'=>'required',
            'sub_type'=>'required',

        ]);


        $service=Service::find(request('id'));
        $service->name=request('name');
        $service->description=request('description');
        $service->ask_price=request('ask_price');
        $service->type=request('type');
        $service->sub_type=request('sub_type');
        $service->user_id=auth()->user()->id;

        $service->save();

        return back();
    }

    public function show(Service $service){

        if(auth()->check() && $service->provider()->id==auth()->user()->id){
            return view('service.edit',compact('service'));
        }else{
            return redirect('/home');
        }

        //return view('service.edit',compact('service'));
    }

    public function s_show(Service $service){
        //dd($service);
        if(auth()->check() && $service->provider()->id==auth()->user()->id){
            return redirect('/service/'.$service->id);
        }else{

            $provider=User::find($service->user_id);
            if (auth()->check()){
                $count=auth()->user()->preference->where('service_id',$service->id)->count();
                if ($count==0){
                    $preference=false;
                } else{
                    $preference=true;
                }
            } else {
                $preference=null;
            }
            if(auth()->check()){
            $request=auth()->user()->incompleterequests->where('service_id',$service->id)->first();
            }else{
                $request=null;
            }


            return view('service.show',compact('service','provider','preference','request'));
        }
    }

    public function destroy(Service $service){
        $service->delete();
        return back();
    }
}
