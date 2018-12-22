<?php

namespace App\Http\Controllers;

use App\Room;
use App\Calendar;
use App\Price;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNewRoom;


class RoomController extends Controller
{
    //
    //

    public function index()
    {
        $rooms = Room::with('roomImages', 'calendars', 'roomCoverImages', 'prices')->get();
        return response()->json([
         "rooms" => $rooms
     ], 200);
    }


    public function show($id)
    {
        $room = Room::where('id', $id)->with('roomImages', 'calendars', 'roomCoverImages', 'prices')->get();
        return response()->json([
         "room" => $room
     ], 200);
    }


    public function store(Request $request)
    {


        $rules = [
          'name' => 'required|unique:rooms',
          'starting_price' => 'required'
        ];
        $messages = [
          'required' => 'Polje :attribute je neophodno.',
          'unique' => 'Polje :attribute - istovetan unos već postoji u bazi',
          'name.unique' => 'Soba sa unesenim imenom već postoji.'
        ];

        $this->validate($request, $rules, $messages);

        //UBAC SOBE
        $room = new Room;
        $room->name = collect(request('name'))->toJson();
        $room->beds = request('beds');
        $room->starting_price = request('starting_price');
        $room->bathroom = request('bathroom');
        $room->kitchen = request('kitchen');
        $room->terrace = request('terrace');
        $room->air_conditioner = request('air_conditioner');
        $room->tv = request('tv');
        $room->wifi = request('wifi');
        $room->description = collect(request('description'))->toJson();
        $room->slogan = collect(request('slogan'))->toJson();
        $room->other_amenities = collect(request('other_amenities'))->toJson();

        try {
            DB::beginTransaction();
            $room_creation = $room->save();

            //UBAC KALENDARA
            $calendar = new Calendar;
            $calendar->reserved_dates = collect([])->toJson();
            $calendar->room_id = $room->id;

            //UBAC CIJENA
            $price = new Price;
            $price->room_id = $room->id;
            $price->prices = collect([["from" => "01.06.2019","to" => "01.06.2019", "price" => "50"]])->toJson();


            $calendar_creation = $calendar->save();
            $prices_creation = $price->save();


            DB::commit();
            return response()->json([
              "message" => 'Soba uspješno kreirana',
              'room_id' => $room->id

            ], 200);
            } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
            "message" => 'Greška pri kreiranju sobe'
        ], 500);
        }
    }




    public function changeProfileImg(Room $room)
    {
        $room->update(['profile_img' => request('selectedImage')]);
    }

    public function changeCoverImg(Room $room)
    {
        $room->update(['cover_img' => request('selectedImage')]);
    }


    public function update(Room $room)
    {
        $room->name = collect(request('name'))->toJson();
        $room->beds = request('beds');
        $room->starting_price = request('starting_price');
        $room->bathroom = request('bathroom');
        $room->kitchen = request('kitchen');
        $room->terrace = request('terrace');
        $room->air_conditioner = request('air_conditioner');
        $room->tv = request('tv');
        $room->wifi = request('wifi');
        $room->description = collect(request('description'))->toJson();
        $room->other_amenities = collect(request('other_amenities'))->toJson();
        $room->slogan = collect(request('slogan'))->toJson();


        $room->save();

        return response()->json([
          "message" => 'Soba uspješno аžurirana'
      ], 200);
    }


    public function delete(Room $room){


      foreach ($room->roomImages as $image) {
        $image->delete();
        \File::delete('images/rooms/'.$image->name);
      }

      foreach ($room->roomCoverImages as $image) {
        $image->delete();
        \File::delete('images/covers/'.$image->name);
      }

      $room->calendars->delete();

      $room->delete();

      return response()->json([
        "message" => 'Soba uspješno obrisana'
      ], 200);
    }
}
