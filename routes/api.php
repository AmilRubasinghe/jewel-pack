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

Route::get('pay', 'PaymentController@payHerePost');

//userModuleRoutes
    Route::post('login', 'UserController@loginUser');
    Route::post('tokensignin', 'GTokenController@verify');

    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ResetPasswordController@process');

    Route::post('register','UserController@registerUser');
    Route::post('resendvEmail','UserController@resendvEmail');
    Route::post('search','ProductController@search');
    
    
    Route::post('guard','UserController@guard');
    Route::post('refresh', 'UserController@refresh');

//CategoryRoutes
    Route::get('category', 'CategoryController@getItem');

    Route::get('products', 'ProductController@getAllProduct');
  //  Route::get('product/{cid}', 'ProductController@getProduct');
    Route::get('category/{cid}', 'ProductController@getProduct');


    Route::post('coupons','CouponController@getCoupon');
    //lotQuntity
    Route::get('getLot', 'LotquantityController@getAllLot');
    //shippingMethod
    Route::get('getMethod', 'shippingmethodController@getShippingMethod');

//Checkout

Route::post('checkDetails','OrderController@saveOrder');

//payment

Route::post('checkoutDetails','PaymentController@store');
Route::post('checkout','PaymentController@payHerePost');
Route::post('checkoutNotify','PaymentController@checkoutNotify');



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


Route::post('addMethod','shippingmethodController@addShippingMethod');
Route::post ( 'deleteShipping/{id}', 'shippingmethodController@deleteShipping' );


Route::post('addProduct','ProductController@addProduct');
Route::post('editProduct/{id}','ProductController@editProduct');
Route::post('deletedProducts','ProductController@getDeletedProducts');
Route::post ( 'deleteProduct/{id}', 'ProductController@deleteProduct' );
Route::post('restoreProduct/{id}', 'ProductController@restoreProduct');


Route::post('upload/product','uploadController@storeProduct');
Route::post('upload/profile','uploadController@storeProfile'); 

Route::post('addCat','CategoryController@addCat');
Route::post('editCat/{id}','CategoryController@editCat');
Route::post ( 'deleteCategory/{id}', 'CategoryController@deleteCat' );
Route::post('restoreCategory/{id}', 'CategoryController@restoreCategory');

Route::get('deletedCategory','CategoryController@getDeletedCat');

Route::post('addProductLot','ProductlotController@addProductlot');

});
Route::get('getImages', 'SlideshowController@getImages');