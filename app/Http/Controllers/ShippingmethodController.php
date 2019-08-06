<?php

namespace App\Http\Controllers;
use App\shippingmethod;

use Illuminate\Http\Request;

class ShippingmethodController extends Controller
{
    public function getShippingMethod()
    {
        $shippingmethod=shippingmethod::all();
    return response()->json(['methodItems'=>$shippingmethod],200);
    
    }



    public function  addShippingMethod(Request $request){  
      
        
        $table = new shippingmethod;
        $table->shipMethod = $request->input('method');
     
  
        $table->save();
  
  
          return response()->json(['shippingmethods'=>$table,'message'=>"Shipping method added succesfully !"]);

    }

    public function deleteShipping($ShipId){
        

        shippingmethod::where(['shipId'=>$ShipId])->delete();
        
        return response()->json(['message'=>"Shipping method deleted succesfully !"]);
      }

   
}
