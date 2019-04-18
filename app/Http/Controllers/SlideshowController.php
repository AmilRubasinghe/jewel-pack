<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\slideshow;
use DB;

class SlideshowController extends Controller
{
    //

    
    public function getImages(){
        // $catItems=category::all();
       
       $images = DB::table('slideshows')->get(); // it will get the entire table
        return response()->json(['images'=>$images],200);
    }

    

	public function storeImage(Request $request){

        $table = new slideshow;
        $table->timestamps = false;
        $table->ext = $request->input('ext');
        $table->size = $request->input('size');
        $table->image = $request->input('image');
        $table->deleteURL = $request->input('delete');

    $table->save();


    return response()->json(['message'=>"Image uploaded succesfully !"]);

        
        
}




    
}
