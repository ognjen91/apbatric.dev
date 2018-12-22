<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  protected $fillable = ['room_id', 'prices'];

  public function prices(){
    return $this->belongsTo('App\Room');
  }
}
