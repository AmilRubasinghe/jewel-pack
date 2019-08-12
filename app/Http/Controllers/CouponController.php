<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coupon;

class CouponController extends Controller
{
    public function getCoupon(){
<<<<<<< HEAD
    
        
    $coupons= coupon::all();
    return response()->json(['coupofgn'=>$coupons],200);
    
=======

      $coupons=coupon::all();
      return response()->json(['coupon'=>$coupons],200);
   
>>>>>>> 0b8c6c48a5a0e8c4e159a757e66f1b39d23d9726
    }

    public function generateCoupon(){

        $voucher->code = $voucher->generateRandomString(6); 
        return response()->json(['coupofgn'=>$coupons],200);
    }



    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    
}
