<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //
    protected $fillable=[
        'service_id',
        'phrase',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
