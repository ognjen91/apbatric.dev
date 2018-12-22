<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Room;

class CalendarController extends Controller
{

   // public function index(){
   //   $rooms = Room::all();
   //   $calendars = [];
   //   foreach ($rooms as $room) {
   //     $calendar = Calendar::where('room_id')
   //   }
   // }


    public function show($room_id){
      $calendar = Calendar::where('room_id', $room_id)->first();
      return response()->json([
          "reserved_dates" => $calendar->reserved_dates
      ], 200);
      }

    public function edit($id){
      $reserved_dates_to_update = collect(request('reserved_dates'))->toJson();
      $calendar = Calendar::where('room_id', $id)->first();
      $calendar->reserved_dates = $reserved_dates_to_update;
      $saved = $calendar->save();

      if($saved){
        return response()->json([
          "message" => 'Izmjene sačuvane'

      ], 200);
      } else {
      return response()->json([
        "message" => 'Greška pri skladištenju izmjena'

      ], 500);
      }
    }

}
