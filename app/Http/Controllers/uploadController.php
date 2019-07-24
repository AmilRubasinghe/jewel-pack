<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadController extends Controller
{
    //

    public function storeSlideshow(Request $request){
        // $catItems=category::all();
       
    // return $request->file('file');
    return $request->file->store('public/slideshow');
        //return response()->json(['images'=>'store success'],200);
    }

    public function storeProduct(Request $request){
        // $catItems=category::all();
       
    // return $request->file('file');
    return $request->file->store('public/product');
        //return response()->json(['images'=>'store success'],200);
    }

    public function storeProfile(Request $request){
        // $catItems=category::all();
       
    // return $request->file('file');
    return $request->file->store('public/profile');
        //return response()->json(['images'=>'store success'],200);
    }


}
