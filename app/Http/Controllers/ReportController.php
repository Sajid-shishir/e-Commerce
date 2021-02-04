<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Order;
use Spatie\QueryBuilder\QueryBuilder;

class ReportController extends Controller
{
    public function report(){
        return view('admin.report');
    }
    public function checkReport(Request $request){


        $searched_orders = QueryBuilder::for(Order::class)
               ->allowedFilters(['created_at'])
               ->get();
               return view('admin.reportResult', compact('searched_orders'));

        // if($request->date){
        //     $date =date('Y-m-d',strtotime($request->date));
        //     $orders = Order::where('created_at',$date)->get();
        //     $sum = Order::where('created_at',$date)->sum('amount');
        //      return view('admin.reportResult',compact('orders','sum','date'));


        // }
        // elseif($request->month && $request->year){

        // }
        // else{

        // }
    }
}
