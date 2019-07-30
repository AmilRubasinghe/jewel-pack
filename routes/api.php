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

//userModuleRoutes
    Route::post('login', 'UserController@loginUser');
    Route::post('register','UserController@registerUser');
    Route::post('resendvEmail','UserController@resendvEmail');
    Route::post('search','ProductController@search');
    
    
    Route::post('guard','UserController@guard');
    Route::post('refresh', 'UserController@refresh');

//NavbarCategoryRoutes
    Route::get('category', 'CategoryController@getItem');

    Route::get('products', 'ProductController@getAllProduct');
  //  Route::get('product/{cid}', 'ProductController@getProduct');
    Route::get('category/{cid}', 'ProductController@getProduct');


    Route::post('coupons','CouponController@getCoupon');
    //lotQuntity
    Route::get('getLot', 'LotquantityController@getAllLot');
   

//Checkout

Route::post('checkDetails','OrderController@saveOrder');

//payment

Route::post('checkoutDetails','PaymentController@store');



//userModuleProtectedRoutes
    Route::group(['middleware' => ['jwt.verify:user,editor,admin']], function() {
        
        Route::post('logout', 'UserController@logoutUser');
        Route::post('me', 'UserController@me');
        
        
    });


    Route::group(['middleware' => 'jwt.verify:admin'], function() {
        
        Route::post('users','UserController@getUsers');
        Route::post('deletedUsers','UserController@getDeletedUsers');
        Route::post('editUser', 'UserController@editUser');
        Route::post('deleteUser/{id}', 'UserController@deleteUser');
        Route::post('restoreUser/{id}', 'UserController@restoreUser');
        Route::post('salesReport', 'salesReport@getReport');
        
        
    });
    
//SlideshowModuleRoutes


Route::group(['middleware' => 'jwt.verify:admin,editor'], function() {
        
    
Route::post('storeImage', 'SlideshowController@storeImage');
Route::post ( 'edititems/{id}', 'SlideshowController@editItem' );
Route::post ( 'deleteSlideshow', 'SlideshowController@deleteItem' );

Route::post('addlot','LotquantityController@addLotItem');
Route::post ( 'deleteLot/{id}', 'LotquantityController@deleteLot' );


Route::post('addProduct','ProductController@addProduct');
Route::post('editProduct/{id}','ProductController@editProduct');
Route::post('deletedProducts','ProductController@getDeletedProducts');
Route::post ( 'deleteProduct/{id}', 'ProductController@deleteProduct' );
Route::post('restoreProduct/{id}', 'ProductController@restoreProduct');


Route::post('upload/product','uploadController@storeProduct');
Route::post('upload/profile','uploadController@storeProfile'); 
});
Route::get('getImages', 'SlideshowController@getImages');