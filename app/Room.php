<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RoomImage;

class Room extends Model
{
    protected $guarded = ['id'];

    public function roomImages(){
      return $this->hasMany('\App\RoomImage');
    }

    public function roomCoverImages(){
      return $this->hasMany('\App\RoomCoverImage');
    }

    public function calendars(){
      return $this->hasOne('App\Calendar');
    }

    public function prices(){
      return $this->hasOne('App\Price');
    }

}
