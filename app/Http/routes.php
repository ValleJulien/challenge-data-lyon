<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Index page
Route::get('/', function () {
    return view('welcome');
});

// Create auto-completion
Route::get('/autocomplete', function () {
    return view('autocomplete');
});

// get Towns data
Route::get('/autocomplete/town', 'AutoCompleteController@getTownAutoComplete');

// get Values
Route::get('/days/{days}', 'GeometryController@getDays');

// get Towns data
Route::get('/towns/{town}', 'GeometryController@getTowns');

// get markets near
Route::get('/market-near', 'GeocodeController@getNearestMarket');

// Cron
Route::get('/cron', 'CronController@updateJson');

/*
|--------------------------------------------------------------------------
| Routes uri for API to Ionic
|--------------------------------------------------------------------------
|
| Route::get('/api/v1/products/{id?}', ['middleware' => 'auth.basic', function($id = null) defines a RESTful URL for version 1 of the API
| The requested resource is Products. {id?} specifies an optional parameter.
| The id is used to retrieve a single product. The API uses basic authentication
| and give it the controller to call when that URI is requested.
|--------------------------------------------------------------------------
| The routes are calling the respective models to retrieve the data from the database.
| return Response::json(…) returns the results in JSON format.
*/




// Route::get('/api/v1/categories/{id?}', ['middleware' => 'auth.basic', function($id = null) {
// if ($id == null) {
//     $categories = App\Category::all(array('id', 'name'));
// } else {
//     $categories = App\Category::find($id, array('id', 'name'));
// }
// return Response::json(array(
//             'error' => false,
//             'user' => $categories,
//             'status_code' => 200
//         ));
// }]);
