<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('/rooms', 'RoomController@index');
    Route::get('/room/{id}', 'RoomController@show');
    Route::post('rooms/create', 'RoomController@store');
    Route::post('rooms/update/{room}', 'RoomController@update');
    Route::post('rooms/add_image/{id}', 'RoomImageController@store');
    Route::post('rooms/add_cover/{id}', 'RoomCoverImageController@store');
    Route::post('rooms/delete_image/{room}', 'RoomImageController@destroy');
    Route::post('rooms/delete_cover/{room}', 'RoomCoverImageController@destroy');
    Route::post('rooms/change_profile/{room}', 'RoomController@changeProfileImg');
    Route::post('rooms/change_cover/{room}', 'RoomController@changeCoverImg');
    Route::post('rooms/{room}/prices', 'PriceController@update');


    Route::post('rooms/remove/{room}', 'RoomController@delete');



    Route::get('/calendars/{id}', 'CalendarController@show');
    Route::post('/calendars/{id}', 'CalendarController@edit');

    Route::post('/events/create', 'EventController@store');
    Route::get('/events', 'EventController@index');
    Route::get('/events/{event}', 'EventController@show');

    //za ove 2 rute je bitan redosljed
    Route::post('events/select_active', 'EventController@change_active');
    Route::post('events/{id}', 'EventController@update');

    Route::post('events/remove/{id}', 'EventController@destroy');

    Route::get('/contacts', 'GuestMailController@index');
    Route::post('contacts/create', 'GuestMailController@store');
    Route::post('contacts/delete', 'GuestMailController@destroy');

    Route::post('mail/create', 'MailController@create');
    Route::get('mails', 'MailController@index');
    Route::get('mail/{mail}', 'MailController@show');

    Route::post('slider/create', 'SliderImageController@store');
    Route::get('slider', 'SliderImageController@index');
    Route::post('slider/update', 'SliderImageController@update');
    Route::post('slider/delete/{id}', 'SliderImageController@destroy');

    Route::post('gallery/create', 'GalleryImageController@store');
    Route::get('gallery', 'GalleryImageController@index');
    Route::post('gallery/update', 'GalleryImageController@update');
    Route::post('gallery/delete/{id}', 'GalleryImageController@destroy');

    Route::post('about/update', 'AboutPageController@update');
    Route::get('about', 'AboutPageController@index');

    Route::post('contact/update', 'ContactPageController@update');
    Route::get('contact', 'ContactPageController@index');


});


Route::group([

    'prefix' => 'public'

], function ($router) {

    Route::get('/rooms', 'RoomController@index');
    Route::get('/slider', 'SliderImageController@index');
    Route::get('/gallery', 'GalleryImageController@index');
    Route::get('/room/{id}', 'RoomController@show');
    Route::get('/events', 'EventController@index');
    Route::get('about', 'AboutPageController@index');
    Route::get('/contact', 'ContactPageController@index');
    Route::post('/contact', 'ContactPageController@sendMailToOwner');

});
