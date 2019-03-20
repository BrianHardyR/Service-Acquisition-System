<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicetype extends Model
{
    //
    protected $fillable=[
        'name',
    ];

    public function servicesubtype(){
        return $this->belongsTo(Servicesubtype::class);
    }
}
