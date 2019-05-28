<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class ProductController extends Controller
{
    //



    public function getProduct(){
        // $catItems=category::all();
       
      // $catItems = DB::table('category')->get(); // it will get the entire table
      //  return response()->json(['catItems'=>$catItems],200);

      $product=product::all();
      return response()->json(['product'=>$product],200);
    }
}
