<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\category;

class CategoryController extends Controller
{
    //


    public function getItem(){
        // $catItems=category::all();
       
      //$catItems = DB::table('categories')->get(); // it will get the entire table
       $catItems = category::where('isDeleted', '=', 0)->get();
        return response()->json(['catItems'=>$catItems],200);
    }

    public function addCat(Request $request){
        //  return $request->input('data');
          //return $request->input('size');
    
        //  $image = $request->file('file');
          //$filename = time().'-'.$image->getClientOriginalName();
          // $image->storeAs('public/product',$filename);
    
    
          $table = new category;
          
          $table->CName = $request->input('CName');

     

        if ($request->input('icon')) {
            $table->icon = $request->input('icon');
        } else{
            $table->icon = "local_mall";
        }

          $table->save();
            return response()->json(['category'=>$table,'message'=>"Category added succesfully !"]);
    
          
          
    }



      

    public function deleteCat($CID){

        category::where(['CID'=>$CID])->update(['isDeleted'=>'1']);
        
        return response()->json(['message'=>"Category deleted succesfully !"]);
      }
      

      

      public function getDeletedCat(){
        // $salesReport=sales_reports::all();
      // echo("report");
       $category = category::where('isDeleted', '=', 1)->get(); 
        return response()->json(['catItems'=>$category],200);
      }


      
      

public function restoreCategory($CID){

    category::where(['CID'=>$CID])->update(['isDeleted'=>'0']);
    return response()->json(['message'=>"Category restored!"]);
  }
}
