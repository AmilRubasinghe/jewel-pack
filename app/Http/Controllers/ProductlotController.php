<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\productlot;
use App\product;
use App\lotquantity;

class ProductlotController extends Controller
{
  public function getProductsLots(Request $request){ 
    $thislot = new productlot;
    $thislot=$request->input('PID');
    //return $thislot;
    //dd($thisship);
   // $shipmethod=productshippingmethod::where('pid','=',$thisship)->get();
    // return $shipmethod;
    $lot=DB::table('productlots')
    ->join('lotquantities','productlots.lid','=','lotquantities.lid')
    ->select('lotquantity')->where('pid','=',$thislot)->get();
    return response()->json(['lotValue'=>$lot,'message'=>"Category edited succesfully !"]);

    


   }
  
        public function addProductlot(Request $request){
            //  return $request->input('data');
              //return $request->input('size');
        
        
        
        
              $table = new productlot;
              $table->lid = $request->input('lid');
              $table->pid = $request->input('pid');
              $table->save();

              $thisProduct=product::findOrFail($request->input('pid'));
                $thisProduct->Quantity = $thisProduct->Quantity+$request->input('quantity');
                $thisProduct->save();
        
                
        
                return response()->json(['productlot'=>$table,'message'=>"Productlot added succesfully !"]);
        
              
              
        }


        public function deleteProductLot(Request $request){
                //  return $request->input('data');
                  //return $request->input('size');
    
                  $thisProduct=product::findOrFail($request->input('pid'));
                    $thisProduct->Quantity = $thisProduct->Quantity-$request->input('quantity');
                    $thisProduct->save();
            
            
                    return response()->json(['productlot'=>$thisProduct,'message'=>"Productlot delected succesfully !"]);
            
                  
                  
            }
}
