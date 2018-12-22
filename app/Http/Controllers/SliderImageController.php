<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderImage;

class SliderImageController extends Controller
{

  public function index(){
    $images = SliderImage::all();
    return response()->json([
        "images" => $images
    ], 200);
  }

  public function store(Request $request){

    $rules = [
      'image' => 'required',
      'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];
    $messages = [
      'image.required' => 'Molimo da izaberete fajl'
    ];

    $this->validate($request, $rules, $messages);

    $no_of_exisitng_active_imgs = count(SliderImage::where('active', '1')->get());
    $new_image_order = $no_of_exisitng_active_imgs + 1;

    if ($request->hasfile('image')) {

          $name= rand(1,10000).$request->file('image')->getClientOriginalName() ;
          $request->file('image')->move(public_path().'/images/slider/', $name);

           SliderImage::create([
            'name' => $name,
            'order' => $new_image_order,
            'active' => 1,
            'text' => collect([
              "sr"=>"Tekst slajda na srpskom",
              "en"=>"Tekst slajda na engleskom",
              "ru"=>"Tekst slajda na ruskom"
              ])->toJson()

          ]);
      }
  }


  public function update(){
    foreach (request('order_update') as $update_img) {
      SliderImage::where('id', $update_img['id'])->update([
        'order'=>$update_img['order'],
        'text'=> collect($update_img['text'])->toJson()
        ]);
    }

    return response()->json([
        "message" => "Promjene su uspješno prihvaćene."
    ], 200);
  }


  public function destroy($id){
     $image = SliderImage::find($id);
     $name = $image->name;
     $image->delete();
     \File::delete('images/slider/'. $name);

     foreach (request('changedOrder') as $data) {
       SliderImage::where('id', $data['id'])->update(['order'=>$data['order']]);
     }

     return response()->json([
         "message" => 'Slika uspješno izbrisana'
     ], 200);


  }
}
