<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;

class RoomImage extends Model
{
    protected $fillable = ['name', 'room_id'];

    public function rooms(){
      return $this->belongsTo('\App\Room', 'room_id');
    }
}
