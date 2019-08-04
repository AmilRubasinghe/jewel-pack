<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Productlot;

class ProductlotController extends Controller
{
    
   
        public function addProductlot(Request $request){
            //  return $request->input('data');
              //return $request->input('size');
        
        
        
        
              $table = new productlot;
              
              $table->lid = $request->input('lid');
              $table->pid = $request->input('pid');
             
        
              $table->save();
        
        
                return response()->json(['productlot'=>$table,'message'=>"Productlot added succesfully !"]);
        
              
              
        }
}
