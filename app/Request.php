<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //
    protected $fillable=[
        'user_id',
        'service_id',
        'status',
        'finish_price',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function difference(){
        $diff=$this->service->ask_price-$this->finish_price;
        if($diff<0){
            $pl='under charged';
        }elseif($diff==0){
            $pl='fair charged';
        }else{
            $pl='over charged';
        }
        return [$pl,$diff];
    }

    public function iscomplete(){
        if($this->status=='complete'){
            return true;
        } else {
            return false;
        }
    }

    public function ispending(){
        if($this->status=='pending'){
            return true;
        } else {
            return false;
        }
    }
}
