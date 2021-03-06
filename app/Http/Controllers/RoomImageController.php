<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomImage;
use App\Room;

class RoomImageController extends Controller
{
    public function store(Request $request, $id)
    {
        $rules = [
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $messages = [
        'image.required' => 'Molimo da izaberete fajl'
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasfile('image')) {
            $name= rand(1, 10000).$request->file('image')->getClientOriginalName() ;
            $request->file('image')->move(public_path().'/images/rooms/', $name);

            RoomImage::create([
              'name' => $name,
              'room_id' => $id
            ]);
        }
    }


    public function destroy(Room $room)
    {
        //treba provjeriti da li je slika za brisanje ujedno
        //i profilna za sobu i ako jeste, treba je izbrisati
        $img = RoomImage::find(request('id'));

        if ($room->profile_img == $img->name) {
            $room->profile_img = "1.jpg";
            $room->save();
        }

        $img->delete();
        \File::delete('images/rooms/'.$img->name);

        return response()->json([
       "message" => 'Slika uspješno izbrisana'

   ], 200);
    }
}
