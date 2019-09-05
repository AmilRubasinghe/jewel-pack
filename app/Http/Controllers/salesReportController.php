<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\salesReport;
use DB;



class salesReportController extends Controller
{
    //
    public function getReport(){
         $salesReport=salesReport::all();
      // echo("report");
      // $salesReport = DB::table('sales_reports')->get(); // it will get the entire table


        return response()->json(['salesReport'=>$salesReport],200);
    }
}
