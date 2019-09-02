<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\productshippingmethod;
use DB;

class ProductController extends Controller
{
    //



    public function getAllProduct(){
        // $catItems=category::all();
       
      // $catItems = DB::table('category')->get(); // it will get the entire table
      //  return response()->json(['catItems'=>$catItems],200);

      
      $product = product::where('isDeleted', '=', 0)->get();
      return response()->json(['product'=>$product],200);
    }



    public function getProduct($cid){
      // $catItems=category::all();
     
    // $catItems = DB::table('category')->get(); // it will get the entire table
    //  return response()->json(['catItems'=>$catItems],200);

   // $product=product::all();
   
    $product = product::where([
      ['CID', '=', $cid],
      ['isDeleted', '=', 0],
      
      ])->get();
    return response()->json(['product'=>$product],200);
  }


  public function search(Request $request){

    $searchQuery = trim($request->keywords);
    $field = ['Size', 'Colour'];
    
    $products=product::where('isDeleted', '=', 0)->
    where(function ($query) use($searchQuery, $field) {
      for ($i = 0; $i < count($field); $i++){
         $query->orWhere($field[$i], 'like',  '%' . $searchQuery .'%');
      }      
 })->get();


      if(count($products) > 0)
      return response()->json(['products'=>$products],200);
  else return response()->json(['message'=>"No Products found. Try to search again !"],200);


/*
    $products = DB::table('products')
      ->where(
        function($result) use ($query){
          $result->where('isDeleted', '=', 0);
          $result->orWhere('Colour', 'LIKE', '%'.$query.'%');
          $result->orWhere('Size', 'LIKE', '%'.$query.'%');
      }
      )->get();
      
    if(count($products) > 0)
        return response()->json(['products'=>$products],200);
    else return response()->json(['message'=>"No Products found. Try to search again !"],200);

*/

/*
    $searchQuery = trim($request->keywords);
    $requestData = ['Size', 'Colour'];
     $products = product::where(function($q) use($requestData, $searchQuery) {
                           foreach ($requestData as $field)
                              $q->orWhere($field, 'like', "%{$searchQuery}%");
                   })->get();
 
                   if(count($products) > 0)
        return response()->json(['products'=>$products],200);
    else return response()->json(['message'=>"No Products found. Try to search again !"],200);

 */
/*$products = product::where('isDeleted', '=', 0)->get();
$searchQuery = trim($request->keywords);
$field = ['Size', 'Colour'];
$products = product::where(function ($query) use($searchQuery, $field) {
             for ($i = 0; $i < count($field); $i++){
                $query->orWhere($field[$i], 'like',  '%' . $searchQuery .'%');
             }      
        })->get();

        if(count($products) > 0)
        return response()->json(['products'=>$products],200);
    else return response()->json(['message'=>"No Products found. Try to search again !"],200);
    */
}


    




    public function addProduct(Request $request){
   
      
      
     // $image = $request->file('file');
      
     // $filename = time().'-'.$image->getClientOriginalName();
     
       //$image->storeAs('public/product',$filename);
      // return $image;

      $table = new product;
      
      $table->Size = $request->input('size');
      $table->CID = $request->input('cid');
      $table->Colour = $request->input('colour');
     
      $table->Price = $request->input('price');
      $table->slashedPrice = $request->input('slashedPrice');
      $table->border = $request->input('border');
      $table->description = $request->input('details');
     // $table->Image = url('/').'/storage/product/'.$filename;

     // $table->ImageName = $filename;

      $table->save();

     
      $shiptable = new productshippingmethod;
     // $shiptable->pid = $table->PID;
     // $shiptable->shipid = $request->input('shipMethod');
     // $shiptable->save();
      $ship = $request->input('method');
      for($i = 0; $i < count($ship); $i++) {
        $shiptable->pid = $table->PID;
        
        $shiptable->shipid = $ship[$i];
        $shiptable->save();

       // $storePicture->picture_id = $i;
        //$storePicture->picture_owner = Auth::user()->id;
       // $storePicture->price = '10';
        //$storePicture->save();
      }

        return response()->json(['product'=>$table,'message'=>"Product added succesfully !"]);

      
      
}




public function editProduct(Request $request, $productId){


//find data by id
/*$institution = $this->institution->find($id);
$filename  = public_path('uploads/institutions/').$institution->avatar;
if(File::exists($filename)) {

  $avatar = $request->file('avatar');
  $filename_new = time() . '.' . $avatar->getClientOriginalExtension();
  Image::make($avatar)->resize(250, 205)->save( public_path('uploads/institutions/' . $filename_new ) );

  //update filename to database
  $institution->avatar = $filename_new;
  $institution->save();    
  //Found existing file then delete
  File::delete($filename);  // or unlink($filename);
*/

  
  $thisProduct=product::findOrFail($productId);
  //$thisImage =slideshow::where('imageId', $imageId)->first();
  $thisProduct->timestamps = false;
  $thisProduct->PID = $request->input('PID');
  $thisProduct->Size = $request->input('Size');
  $thisProduct->CID = $request->input('CID');
  $thisProduct->Image = $request->input('Image');
  $thisProduct->Quantity = $request->input('Quantity');
  $thisProduct->Colour = $request->input('Colour');
  $thisProduct->Price = $request->input('Price');
  $thisProduct->unitWeight = $request->input('unitWeight');
  $thisProduct->border = $request->input('border');
  $thisProduct->description = $request->input('description');
  

  $thisProduct->save();

      $thisship = new productshippingmethod;
      $thisship->pid = $request->input('PID');
      $thisship->shipid= $request->input('shipMethod');
      $thisship->save();

  
  return response()->json(['editedProduct'=>$thisProduct,'message'=>"Product edited succesfully !"]);
}


public function deleteProduct($productId){

  product::where(['PID'=>$productId])->update(['isDeleted'=>'1']);
  
  return response()->json(['message'=>"Product deleted succesfully !"]);
}



public function restoreProduct($PID){

  product::where(['PID'=>$PID])->update(['isDeleted'=>'0']);
}



public function getDeletedProducts(){
  // $salesReport=sales_reports::all();
// echo("report");
 $products = product::where('isDeleted', '=', 1)->get(); 
  return response()->json(['product'=>$products],200);
}



public function addHomeProduct(Request $request){
  $items = $request->input('PIDList');

 // $selectItems = product::where('isSelected', '=', 1)->get();
  //$titles = product::table('products')->pluck('PID' , 'isSelected');
  $products = product::where('isSelected', '=', 1)->get();

   product::where(['isSelected'=>'1'])->update(['isSelected'=>'0']);
  
  for ($i = 0; $i < count($items); $i++){

  product::where(['PID'=> $items[$i]])->update(['isSelected'=>'1']);
}
 return response()->json(['message'=>"Featured Products added succesfully !"]);
   }

    
    


}
