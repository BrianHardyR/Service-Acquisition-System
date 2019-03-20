<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function hasprofile(){
        if ($this->hasOne(Profile::class)->count()==0){
            return false;
        }else{
            return true;
        }
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }

    public function incompleterequests(){
        return $this->hasMany(Request::class)->where('status','!=','complete');
    }

    public function preference(){
        return $this->hasMany(Preference::class);
    }

    public function isprovider(){
        if($this->hasMany(Service::class)->count()>0){
            return true;
        }else{
            return false;
        }
    }

    public function providers(){
        return $this->all();
    }

    public function isAdmin(){
        return true;//should change this asaps
    }

    public function sent(){
        return $this->hasMany(Message::class);
    }

    public function recieved(){
        $msg=Message::all()->where('reciever_user_id',$this->id);
        return $msg;
    }

    public function unread(){
        $msg=Message::all()->where('reciever_user_id',$this->id)->where('read','false');
        return $msg;
    }

    public function read(){
        $msg=Message::all()->where('reciever_user_id',$this->id)->where('read','true');
        return $msg;
    }

    public function busy(){
        $count=0;
       foreach($this->services as $service){
            if($service->acceptedrequests->count()>0){
                $count=$count+1;
            }
       }
       if($count==0){
           return false;
       }else{
           return true;
       }

    }

    public function notify(){
        $count=0;
       foreach($this->services as $service){
            if($service->pendingrequests->count()>0){
                $count=$count+1;
            }
       }
       if($count==0){
           return '';
       }else{
           return $count;
       }

    }
}
