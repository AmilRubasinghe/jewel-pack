<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class salesReport extends Controller
{
    //
    public function getReport(){
        // $salesReport=sales_reports::all();
      // echo("report");
       $salesReport = DB::table('sales_reports')->get(); // it will get the entire table
        return response()->json(['salesReport'=>$salesReport],200);
    }
}
