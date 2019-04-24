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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
Route::post('/login',[
    'uses'=>'UserController@loginUser'
]);*/


Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    

});
/*
Route::post('/register',[
    'uses'=>'UserController@registerUser'

]);*/

//userModuleRoutes
    Route::post('login', 'UserController@loginUser');
    Route::post('refresh', 'UserController@refresh');
    Route::post('register','UserController@registerUser');
    Route::post('guard','UserController@guard');
    Route::post('users','UserController@getUsers');

//NavbarCategoryRoutes
    Route::get('category', 'CategoryController@getItem');
    

//userModuleProtectedRoutes
    Route::group(['middleware' => ['jwt.verify:user,editor,admin']], function() {
        
        Route::post('logout', 'UserController@logoutUser');
        Route::post('me', 'UserController@me');
        
        
    });


    Route::group(['middleware' => 'jwt.verify:admin'], function() {
        
        Route::post('editUser', 'UserController@editUser');
        Route::post('salesReport', 'salesReport@getReport');
        
        
    });
    
//SlideshowModuleRoutes


Route::group(['middleware' => 'jwt.verify:admin,editor'], function() {
        
    
Route::post('storeImage', 'SlideshowController@storeImage');
Route::post ( 'edititems/{id}', 'SlideshowController@editItem' );
Route::post ( 'deleteSlideshow/{id}', 'SlideshowController@deleteItem' );
    
    
});
Route::get('getImages', 'SlideshowController@getImages');