<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestMail;

class GuestMailController extends Controller
{


  public function index(){
    $contacts = GuestMail::all();
    return response()->json([
        "contacts" => $contacts
    ], 200);
  }



    public function store(Request $request){
      $rules = [
        'name' => 'required',
        'mail' => 'required|unique:guest_mails|email'
      ];
      $messages = [
      'required' => 'Polje :attribute je neophodno.',
      'mail.unique' => 'Uneseni mail već postoji u bazi',
      'email' => 'Molimo unesite validan mail'
    ];

    $this->validate($request, $rules, $messages);

    $contact = new GuestMail;
    $contact->name = request('name');
    $contact->mail = request('mail');
    $created = $contact->save();

    if ($created) {return response()->json([
        "message" => 'Kontakt je dodat.'
    ], 200);
  } else {
    return response()->json([
        "message" => 'Greška pri dodavanju kontakta.'
    ], 500);
  }
    }


    public function destroy(){
     GuestMail::destroy(request('id'));
     return response()->json([
         "message" => 'Kontakt je izbrisan.'
     ], 200);
    }
}
