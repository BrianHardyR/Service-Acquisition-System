<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable=[
        'lat','lng','county','city','district','description','service_id'
    ];

    public function service(){
        return $this->hasMany(Service::class);
    }
}
