<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable=[
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'alternate_number',
        'address',
        'town',
        'country',
    ];
    protected $hidden=[
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'alternate_number',
        'address',
        'town',
        'country',
    ];

    public function user(){
        return $this->hasOne(User::class0);
    }

    public function fullname(){
        $name=$this->first_name.' '.$this->middle_name.' '.$this->last_name;
        return $name;
    }

    public function fulladdress(){
        $address=$this->address.' '.$this->town.' '.$this->country;
        return $address;
    }


}
