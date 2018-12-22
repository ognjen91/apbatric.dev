<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactPage;

class ContactPageController extends Controller
{
    ///IZLISTAVANJE PODATAKA, ako ne postoje i kreacija
public function index(){
    $data = ContactPage::firstOrCreate(['id'=>1]);
    $data->save();

// dd($textExists);
    return response()->json([
      "data" => $data
    ], 200);
    }



  // KREIRANJE ILI UPDATE TEKSTA
    public function update(Request $request){

      ContactPage::updateOrCreate(
        ['id'=>1],
        [
          'adress'=>request('adress'),
          'phone1'=>request('phone1'),
          'phone2'=>request('phone2'),
          'email'=>request('email'),
          'skype'=>request('skype'),
          'facebook'=>request('facebook'),
          'instagram'=>request('instagram')
       ]
      );

        return response()->json([
          "message" => 'Uspješno'
        ], 200);
    }

    public function sendMailToOwner(){
      $from = request('from');
      $email = request('email');
      $text = request('text');
      $title = request('title')? request('title') : 'Nova poruka od gosta';
      $arrival = request('arrival');
      $departure = request('departure');
      $room_id = request('room_id');

      //TREBA POSLATI U MAILU!!!

      return response()->json([
        "message" => 'Uspješno'
      ], 200);
    }


}
