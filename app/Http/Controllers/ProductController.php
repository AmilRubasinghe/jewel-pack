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
   

   // $arr =  $request->input('method');
     

       $arr = json_decode($request->input('method'));
     // return $arr[2]->shipId;
     //return count($arr);
     //image A
      $image1 = $request->file('photoA');
      // return $image1;
      $filename1 = time().'-'.$image1->getClientOriginalName();
    
       $image1->storeAs('public/product',$filename1);


      //image B
       $image2 = $request->file('photoB');
       /// return $image2;
        $filename2 = time().'-'.$image2->getClientOriginalName();
      // return $filename;
         $image2->storeAs('public/product',$filename2);


        //image C
         $image3 = $request->file('photoC');
       //return $image3;
          $filename3 = time().'-'.$image3->getClientOriginalName();
        // return $filename;
           $image3->storeAs('public/product',$filename3);
          //return $image3;
          ////image D
           $image4 = $request->file('photoD');
          // return $image;
            $filename4 = time().'-'.$image4->getClientOriginalName();
          //return $filename4;
             $image4->storeAs('public/product',$filename4);
           //return $image4;

      $table = new product;
      
      $table->Size = $request->input('size');
      $table->CID = $request->input('cid');
      $table->Colour = $request->input('colour');
     
      $table->Price = $request->input('price');
      $table->slashedPrice = $request->input('slashedPrice');
      $table->border = $request->input('border');
      $table->description = $request->input('details');

      $table->Image1 = url('/').'/storage/product/'.$filename1;
      $table->ImageName1 = $filename1;

      $table->Image2 = url('/').'/storage/product/'.$filename2;
      $table->ImageName2 = $filename2;

      $table->Image3 = url('/').'/storage/product/'.$filename3;
      $table->ImageName3 = $filename3;

      $table->Image4 = url('/').'/storage/product/'.$filename4;
      $table->ImageName4 = $filename4;

      $table->save();

     
      $shiptable = new productshippingmethod;
     // $shiptable->pid = $table->PID;
     // $shiptable->shipid = $request->input('shipMethod');
     // $shiptable->save();
     // $ship = $request->input('method');
     

      for($i = 0; $i < count($arr); $i++) {
        $shiptable = new productshippingmethod;
        $shiptable->pid = $table->PID;
        
        $shiptable->shipid =$arr[$i]->shipId;

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

    
    
   public function getselectedProducts (){
   
  
  $product = product::where('isSelected', '=', 1)->get();
  return response()->json(['selectedProducts'=>$product],200);
}

}
