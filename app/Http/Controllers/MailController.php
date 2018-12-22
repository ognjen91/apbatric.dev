<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail;

class MailController extends Controller
{


  public function index(){
    $mails =  Mail::all();
    return response()->json([
        "mails" => $mails
    ], 200);
  }


  public function show(Mail $mail){
    return response()->json([
        "mail" => $mail
    ], 200);

     }


    public function create(Request $request){
      $rules = [
        'title' => 'required',
        'body' => 'required'
      ];
      $messages = [
      'required' => 'Polje :attribute je neophodno.'
    ];

    $this->validate($request, $rules, $messages);

    $mail = new Mail;
    $mail->title = request('title');
    $mail->body = request('body');
    $mail->to = collect(request('to'))->toJSON();
    $mail->save();
//
    // foreach ($mail->to as $key => $guest) {
      // code...
    // }
   // \Mail::
   //
   return response()->json([
       "message" => 'Mail je poslat.'
   ], 200);

    }
}
