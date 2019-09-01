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
        $table->flatRate = $request->input('flatRate');
  
        $table->save();
  
  
          return response()->json(['shippingmethods'=>$table,'message'=>"Shipping method added succesfully !"]);

    }

    public function deleteShipping($ShipId){
        

        shippingmethod::where(['shipId'=>$ShipId])->delete();
        
        return response()->json(['message'=>"Shipping method deleted succesfully !"]);
      }

      public function editShippingMethod(Request $request, $shipId){
        $thisMethod=shippingmethod::findOrFail($shipId);
        //$thisImage =slideshow::where('imageId', $imageId)->first();
        $thisMethod->timestamps = false;
        $thisMethod->shipId = $request->input('shipId');
        $thisMethod->shipMethod = $request->input('shipMethod');
        $thisMethod->flatRate = $request->input('flatRate');
      
        
      
        $thisMethod->save();
        
        return response()->json(['editedshippingmethod'=>$thisMethod,'message'=>"Shipping method edited succesfully !"]);
      }

   
}
