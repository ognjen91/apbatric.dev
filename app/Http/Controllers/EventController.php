<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{

 public function index(){
   return response()->json([
       "events" => Event::all()
   ], 200);
 }



    public function store(Request $request){
      // dd(request('name'));

      $rules = [
        'name.sr' => 'required',
        'preview.sr' => 'required|min:20|max:150',
        'description.sr' => 'required|min:50'

      ];
      $messages = [
      'name.sr.required' => 'Neophodno je da unesete naziv promocije na srpskom.',
      'preview.sr.required' => 'Neophodno je da unesete kratak opis promocije na srpskom.',
      'description.sr.required' => 'Neophodno je da unesete duzi opis promocije na srpskom.',
      'max' => 'Polje :attribute može imati maksimalno :max karaktera',
      'min' => 'Polje :attribute može imati minimalno :min karaktera',

      ];

      $this->validate($request, $rules, $messages);

      //UBAC PROMOCIJE
      Event::create(
      [
        'name' => collect(request('name'))->toJson(),
        'description' => collect(request('description'))->toJson(),
        'preview' => collect(request('preview'))->toJson(),
        'start' => request('start'),
        'finish' => request('finish')

      ]
      );

      return response()->json([
        "message" => 'Promocija uspješno kreirana'
      ], 200);
    }

    public function update(Request $request, $id){
      $rules = [
        'name.sr' => 'required',
        'preview.sr' => 'required|min:20|max:150',
        'description.sr' => 'required|min:50'

      ];
      $messages = [
      'name.sr.required' => 'Neophodno je da unesete naziv promocije na srpskom.',
      'preview.sr.required' => 'Neophodno je da unesete kratak opis promocije na srpskom.',
      'description.sr.required' => 'Neophodno je da unesete duzi opis promocije na srpskom.',
      'max' => 'Polje :attribute može imati maksimalno :max karaktera',
      'min' => 'Polje :attribute može imati minimalno :min karaktera',

      ];

      $this->validate($request, $rules, $messages);

      //UBAC PROMOCIJE
      Event::where('id', $id)->update(
        [
          'name' => collect(request('name'))->toJson(),
          'description' => collect(request('description'))->toJson(),
          'preview' => collect(request('preview'))->toJson(),
          'start' => request('start'),
          'finish' => request('finish')

        ]
      );

      return response()->json([
        "message" => 'Promocija uspješno izmjenjena'
      ], 200);
    }


public function show(Event $event){
  return response()->json([
      "event" => $event
  ], 200);
}


public function destroy($id){
  Event::destroy($id);
}


public function change_active(){
  Event::where('id', '!=', request('id'))->update(
    [
      'active' => '0'
    ]);
    Event::where('id', request('id'))->update(
      [
        'active' => '1'
      ]);
}
}
