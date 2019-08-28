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
            $tableU->contactNo = $request->input('phone');
            
            
            $tableU->save();

        }

        
            $user = User::where('email', '=', $request->input('email'))->first();
        

        //return $user->ID;
        

        $table = new order;
        $table->timestamps = true;
        $table->ID =  $user->ID;
        $table->customerEmail =$request->input('email') ;
        $table->contactNo = $request->input('phone');
        $table->deliveryAddress = $request->input('address');

    $table->save();


    return response()->json(['order'=>$table,'message'=>"Order placed succesfully !"]);
       
    }

    public function getOrder(){
        $order = DB::table('orders')->orderBy('created_at','desc')->first(); // it will get the entire table
        return response()->json(['printOrder'=>$order],200);
    }

    public function myOrder(Request $request){
        $token= $request->input('token');
        $userID = JWTAuth::toUser($token)->ID;


       $orders = order::where('ID', '=', $userID)->get();

        return response()->json(['orders'=>$orders]);
    }


}
