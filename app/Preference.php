<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //
    protected $fillable=[
        'user_id',
        'service_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return  $this->belongsTo(Service::class);
    }

    public function provider(){
        return service()->provider;
    }
}
