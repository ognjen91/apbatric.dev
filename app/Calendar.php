<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
  protected $fillable = ['room_id', 'calendars'];

    public function rooms(){
      return $this->belongsTo('App\Room');
    }
}
