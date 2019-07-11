<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coupon;

class CouponController extends Controller
{

    public function getCoupon(){
    

    $coupons= coupon::all();
    return response()->json(['coupofgn'=>$coupons],200);
    
    }
}
