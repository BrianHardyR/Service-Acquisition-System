<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicelocation extends Model
{
    //
    protected $fillable=[
        'service_id','location_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
