<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\productshippingmethod;
use App\shippingmethod;
use DB;

class ProductshippingmethodController extends Controller
{
    //


    public function getProductShippingMethod(Request $request){
        $thisship = new productshippingmethod;
        $thisship=$request->input('PID');
        //return $thisship;
        //dd($thisship);
       // $shipmethod=productshippingmethod::where('pid','=',$thisship)->get();
        // return $shipmethod;
        $ship=DB::table('productshippingmethods')
        ->join('shippingmethods','productshippingmethods.shipid','=','shippingmethods.shipId')
        ->select('shipMethod')->where('pid','=',$thisship)->get();
        return response()->json(['shipmethod'=>$ship,'message'=>"Category edited succesfully !"]);

    }
    
}
