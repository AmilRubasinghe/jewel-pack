<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\order;
use JWTAuth;

class OrderController extends Controller
{
    //
    
    
	public function saveOrder(Request $request){

  
            $user = User::where('email', '=', $request->input('email'))->first();
           // $user = User::where('email', '=', Input::get('email'))->first();
       
  

        if(!$user){
            


			$tableU = new User;
			$tableU->firstName = $request->input('firstname');
			$tableU->lastName = $request->input('lastname');
			$tableU->email = $request->input('email');
            
            $tableU->save();

        }

        
            $user = User::where('email', '=', $request->input('email'))->first();
        

        //return $user->ID;
        

        $table = new order;
        $table->timestamps = false;
        $table->ID =  $user->ID;
        $table->contactNo = $request->input('phone');
        $table->deliveryAddress = $request->input('address');

    $table->save();


    return response()->json(['order'=>$table,'message'=>"Order placed succesfully !"]);
       
    }

    public function sendOrder(){
    
    }

    public function myOrder($token){
        $userID = JWTAuth::toUser($token)->ID;


       $orders = order::where('ID', '=', $userID)->get();

        return response()->json(['orders'=>$orders]);
    }


}
