<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicesubtype extends Model
{
    //
    protected $fillable=[
        'servicetype_id',
        'name',
    ];

    public function servicetype(){
        return $this->belongsTo(Servicetype::class);
    }

}
