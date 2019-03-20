<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable=[
        'user_id',
        'reciever_user_id',
        'message',
        'read',
    ];

    protected $hidden=[
        'message',
        'read',
    ];

    public function sender(){
        return $this->belongsTo(User::class);
    }

    public function reciever(){
        $user=User::all()->where('id',$this->reciever_user_id)->first();
        return $user;
    }

    public function isread(){
        if ($this->read=='true'){
            return true;
        }else{
            return false;
        }
    }
}
