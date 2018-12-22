<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GalleryImage;

class GalleryImageController extends Controller
{

  public function index(){
    $images = GalleryImage::all();
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

    $no_of_exisitng_active_imgs = count(GalleryImage::where('active', '1')->get());
    $new_image_order = $no_of_exisitng_active_imgs + 1;


    if ($request->hasfile('image')) {

          $name= rand(1,10000).$request->file('image')->getClientOriginalName() ;
          $request->file('image')->move(public_path().'/images/gallery/', $name);

           GalleryImage::create([
            'name' => $name,
            'order' => $new_image_order,
            'active' => 1

          ]);
      }
  }


  public function update(){
    foreach (request('order_update') as $update_img) {
      GalleryImage::where('id', $update_img['id'])->update(['order'=>$update_img['order']]);
    }

    return response()->json([
        "message" => "Promjene su uspješno prihvaćene."
    ], 200);
  }


  public function destroy($id){
     $image = GalleryImage::find($id);
     $name = $image->name;
     $image->delete();
     \File::delete('images/gallery/'. $name);

     foreach (request('changedOrder') as $data) {
       GalleryImage::where('id', $data['id'])->update(['order'=>$data['order']]);
     }

     return response()->json([
         "message" => 'Slika uspješno izbrisana'
     ], 200);


  }
}
