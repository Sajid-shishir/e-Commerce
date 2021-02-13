<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use PDF;
use Carbon\Carbon;
use App\Coupon;
use App\Product;
use App\Order_list;
use DB;


use App\Mail\payment;
use Illuminate\Support\Facades\Mail;
use App\User;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('verified')->except(['show']);
        $this->middleware('checkrolecustomer');
    }

     function homecustomer(){

       $customer_orders = Order::where('user_id',Auth::id())->orderBy('id','desc')->paginate(5);
    //    $customer_orders =Order::paginate(10);
        $product_info = Order_list::where('product_id')->get();
        return view('customer.home',compact('customer_orders','product_info'));

    }

    function orderdownload($order_id){

    //    $data = DB::table('order_lists')->join('products',);

       $order_list = Order_list::where('order_id',$order_id)->first();
        $product =Product::where('id',$order_list->product_id)->first();

         



       $order_info = Order::findOrFail($order_id);
       $dynamic_name = "Invoice-".$order_info->id."-".Carbon::now()->format('d-m-Y').".pdf";
       $order_pdf = PDF::loadView('customer.download.order',compact('order_info','dynamic_name','order_list','product'));
       return $order_pdf->download($dynamic_name);

       foreach(User::where(Auth::user())->get() as $user){

        Mail::to($request->user())->send(new payment($order_pdf));
    }
        // echo $order_id;


    }
    function addreview(Request $request){

        // print_r($request->all());
        $order_list =Order_list::where('user_id',Auth::id())->where('product_id',$request->product_id)->whereNull('review')->first()->update([
            'review' =>$request->review,
            'star' =>$request->star

        ]);
        return back();

    }
}
