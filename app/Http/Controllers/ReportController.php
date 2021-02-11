<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Order;
use App\Order_list;
use App\Report;
use Spatie\QueryBuilder\QueryBuilder;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function report(){

        return view('admin.report');
    }
    public function checkReport(Request $request){
        // dd($request->all());

//         $point->delete();
// return redirect();

        // $searched_orders = Order::whereMonth('created_at', date($request->created_at))->paginate(5);

        // $time =Order::find('created_at');
        // $order_lists = Order_list::latest()->Paginate(5);
        // $orders = App\Order_list::Paginate(15);
        // $order_lists = DB::table('order_lists')->Paginate(5);
        $searched_orders = QueryBuilder::for(Order::class)
               ->allowedFilters(['created_at'])
               ->Paginate(5);
                // ->get();
               return view('admin.reportResult', compact('searched_orders'));


    }

    public function checkReportFrom(Request $request){

        $start = request()->input('start');
        $end = request()->input('end');
        // $end =  strtotime($end);
        // $end = $end +86399;
        // if (request()->has('start')) {
        //     $start = Carbon::parse(request()->get('start'))->format('Y-m-d') . ' 00:00:00';
        //     $query->where('created_at', '>=', $start);
        // }

        // if (request()->has('to')) {
        //     $to = Carbon::parse(request()->get('to'))->format('Y-m-d') . ' 23:59:59';
        //     $query->where('signInTime', '<=', $from);
        // }

        $end = Carbon::parse(request()->get('end'))->format('Y-m-d') . ' 23:59:59';

        $data = DB::table('orders')
        ->whereBetween('orders.created_at', [$start, $end])
        ->get();
        // $data=DB::table('orders')->where('orders.created_at','>=',$start)->orwhere('orders.created_at', '<=', $end)->get();

        return view('admin.report_from', ['start'=>$start,'end'=>$end,'data' => $data]);

    }
}
