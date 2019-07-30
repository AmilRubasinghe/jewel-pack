<?php

namespace App\Http\Controllers;

use App\lotquantity;

use Illuminate\Http\Request;

class LotquantityController extends Controller
{
    public function getAllLot()
    {
        $lotquantity=lotquantity::all();
    return response()->json(['lotItems'=>$lotquantity],200);
    
    }
    
    public function addLotItem(Request $request){
        
      
        
        $table = new lotquantity;
        $table->lotquantity = $request->input('LotValue');
     
  
        $table->save();
  
  
          return response()->json(['lotquantities'=>$table,'message'=>"Lot added succesfully !"]);

    }

    public function deleteLot($lotId){
        

        lotquantity::where(['lid'=>$lotId])->delete();
        
        return response()->json(['message'=>"Lot deleted succesfully !"]);
      }

}
