<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service as s;
use App\User as u;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    //
    public function index(){
        return view('search.index');
    }

    public function result(){

        $service=s::where('name','LIKE','%'.request('search').'%')
                    ->orWhere('description','LIKE','%'.request('search').'%')
                    ->get()
                    ->take(10);
        return $service;
    }

    public function search(){
        $service=new Collection();
        $close=new Collection();
        $medium=new Collection();
        $far=new Collection();
        $veryfar= new Collection();
        $provider=new Collection();
        $okay=false;
        $uncheck=s::where('name','LIKE','%'.request('search').'%')
                    ->orWhere('description','LIKE','%'.request('search').'%')
                    ->get();

        foreach($uncheck as $S){
            foreach($S->locations as $l){
               if($l->city==request('city')){
                   //close
                   $close->push($S);
                   break;
               }elseif($l->district==request('district')){
                    //medium
                    $medium->push($S);
                    break;
               }elseif($l->county==request('county')){
                    //far
                    $far->push($S);
                    break;
               }else{
                   //very far
                   $veryfar->push($S);
                   break;
               }
            }

        }
        foreach($close as $c){
            $service->push($c);
        }
        foreach($medium as $c){
            $service->push($c);
        }
        foreach($far as $c){
            $service->push($c);
        }
        foreach($veryfar as $c){
            $service->push($c);
        }



        $okay=false;
        $uncheck=u::all();


        foreach($uncheck as $U){
            if($U->profile!=null){
                if(
                    $U->isprovider() &&(
                    $U->profile->where('first_name','LIKE','%'.request('search').'%')->count() ||
                    $U->profile->where('middle_name','LIKE','%'.request('search').'%')->count() ||
                    $U->profile->where('last_name','LIKE','%'.request('search').'%')->count() ||
                    $U->where('email','LIKE','%'.request('search').'%')->count()
                    )
                ){
                    $provider->push($U);
                }
            }
        }

       $response=new Collection([
            'service'=>$service->toArray(),
           'provider'=>$provider->toArray()

       ]);

        return $response;
    }

    public function store(){
        return request();

    }
}
