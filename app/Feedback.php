<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable=[
        'user_id',
        'request_id',
        'service_id',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function request(){
        return $this->belongsTo(Request::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
