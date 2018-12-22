<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;

class PriceController extends Controller
{


public function update($id){
  $prices = collect(request('price'))->toJson();

  Price::where('room_id', $id)->update(['prices' => $prices]);



  return response()->json([
    "message" => 'Uspješno',
  ], 200);
}


}
