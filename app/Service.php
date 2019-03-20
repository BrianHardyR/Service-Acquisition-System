<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable=[
        'name',
        'description',
        'ask_price',
        'type',
        'sub_type',
        'user_id',
    ];
    protected $hidden=[

    ];

    public function provider(){

        return User::find($this->user_id);
    }

    public function search(){
        return $this->hasMany(Search::class);
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }

    public function hits(){
        return $this->hasMany(Search::class)->count();
    }

    public function locations(){
       return $this->hasMany(Location::class);
    }

    public function incompleterequests(){
        return $this->hasMany(Request::class)->where('status','!=','complete');
    }

    public function completerequests(){
        return $this->hasMany(Request::class)->where('status','complete');
    }

    public function pendingrequests(){
        return $this->hasMany(Request::class)->where('status','pending');
    }

    public function acceptedrequests(){
        return $this->hasMany(Request::class)->where('status','accept');
    }



    public function feedback(){
        return $this->hasMany(Feedback::class);
    }


}
