<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact_us;


class ContactUsController extends Controller
{
    //

    public function getAll(){

        $Msg=contact_us::all();
        return response()->json(['Msg'=>$Msg],200);

     }


     public function save(Request $request){
            
            $table = new contact_us;
            $table->name = $request->input('name');
            $table->email = $request->input('email');
            $table->phone = $request->input('phone');
            $table->message = $request->input('msg');

            $table->save();
            return response()->json(['data'=>'Succesfully Received Your Message'],200);
    }

            

}
