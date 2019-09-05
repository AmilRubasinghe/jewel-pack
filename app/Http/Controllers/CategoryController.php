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
      
        

          $image = $request->file('file');
          $filename = time().'-'.$image->getClientOriginalName();
           $image->storeAs('public/catagory',$filename);
    
          $table = new category;
          
          $table->CName = $request->input('CName');

         

        if ($request->input('icon')) {
            $table->icon = $request->input('icon');
        } else{
            $table->icon = "local_mall";
        }
        $table->Image = url('/').'/storage/catagory/'.$filename;
        $table->ImageName = $filename;
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


public function editCat(Request $request, $CID){

  

 
  $thisCat=category::findOrFail($CID);
 // if ( $request->file('file')) {
  $image_path = category::where('CID', $CID)->first()->ImageName;
  //return  $image_path;
 // $dell = category::select(['ImageName','Image'])->where('CID', $CID)->get();
//$dell->delete();
 // $table = category::where('CID', $CID)->delete(['ImageName']);
 // return $dell;
  \Storage::delete('public/catagory/'.$image_path);
  
  //return ('public/catagory/'.$image_path);
 
  $image = $request->file('file');
  $filename = time().'-'.$image->getClientOriginalName();
  $image->storeAs('public/catagory',$filename);
    
 
  //}
    
     $thisCat->CName = $request->input('CName');

   

  if ($request->input('icon')) {
    $thisCat->icon = $request->input('icon');
  } else{
    $thisCat->icon = "local_mall";
  }
  $thisCatImage = url('/').'/storage/catagory/'.$filename;
  $action = category::where('CID', $CID)
    ->first()
    ->update([
        'Image' => $thisCatImage ,
        'ImageName' => $filename
    ]);
 // $thisCat->Image = url('/').'/storage/catagory/'.$filename;
 // $thisCat->ImageName = $filename;
  $thisCat->save();
      return response()->json(['category'=>$thisCat,'message'=>"Category edited succesfully !"]);

    
    
}
}