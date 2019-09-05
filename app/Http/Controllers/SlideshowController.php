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
        $image = $request->file('file');
        $filename = time().'-'.$image->getClientOriginalName();
        $image->storeAs('public/slideshow',$filename);

        $table = new slideshow;
        $table->name = $filename;
        
        $table->path = url('/').'/storage/slideshow/'.$filename;

    $table->save();
    return response()->json(['message'=>$table,'message'=>"Image uploaded succesfully !"]);      
        
}


public function editItem(Request $request, $imageId){
    $thisImage=slideshow::findOrFail($imageId);
    //$thisImage =slideshow::where('imageId', $imageId)->first();
    
    $thisImage->path = $request->input('path');
    $thisImage->name = $request->input('name');
    $thisImage->save();
    
    return response()->json(['editedImage'=>$thisImage,'message'=>"Product edited succesfully !"]);
}


public function deleteItem(Request $request) {
    $table = slideshow::findOrFail( $request->input('imageID'))->delete();
    \Storage::delete('public/slideshow/'.$request->input('name'));
    
    return response()->json(['message'=>"Photo deleted succesfully !"]);
}




    
}
