<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutPage;

class AboutPageController extends Controller
{

    //IZLISTAVANJE TEKSTA, a ako ne postoji i KREIRANJE
public function index(){
  $data = AboutPage::firstOrCreate(['id'=>1], ['text' =>  collect(["sr"=>"", "en"=>"", 'ru'=>""])]);
  $data->save();

// dd($textExists);
    return response()->json([
      "text" => $data->text
    ], 200);
    }



  // KREIRANJE ILI UPDATE TEKSTA
    public function update(Request $request){

      $rules = [
        'about.sr' => 'required'

      ];
      $messages = [
        'required' => 'Polje "OPIS NA SRPSKOM" je neophodno'
      ];

      $this->validate($request, $rules, $messages);


      $texts = AboutPage::where('id', 1)->first();
      if($texts === null){
        $isOk = AboutPage::create(['text' =>  collect(["sr"=>"", "en"=>"", 'ru'=>""])->toJson()]);
      } else {
        $texts->text = collect(request('about'));
        $isOk = $texts->save();
      }



        if ($isOk) return response()->json([
          "message" => 'Uspješno'
        ], 200);
    }



}
