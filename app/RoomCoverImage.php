<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomCoverImage extends Model
{
protected $fillable = ['name', 'room_id'];

  public function rooms(){
    return $this->belongsTo('\App\Room', 'room_id');
  }
}
