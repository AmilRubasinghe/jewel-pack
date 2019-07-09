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


    public function addProduct(Request $request){

      $table = new product;
      $table->timestamps = false;
      $table->Size = $request->input('size');
      $table->Colour = $request->input('colour');
      $table->Quantity = $request->input('quantity');
      $table->Price = $request->input('price');

      $table->save();


        return response()->json(['product'=>$table,'message'=>"Product added succesfully !"]);

      
      
}
}
