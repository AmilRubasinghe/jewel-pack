<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    //


    public function getItem(){
        // $catItems=category::all();
       
       $catItems = DB::table('category')->get(); // it will get the entire table
        return response()->json(['catItems'=>$catItems],200);
    }
}
