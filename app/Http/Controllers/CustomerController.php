<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;
use App\Coupon;
use App\Product;
use App\Order_list;
use DB;
use App\Mail\payment;
use Illuminate\Support\Facades\Mail;
use App\User;
use Spatie\QueryBuilder\QueryBuilder;

use Illuminate\Support\Str;

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
       $order_info = Order::findOrFail($order_id);
       $order_list = Order_list::select('id','order_id', 'product_id','amount')->where('order_id',$order_id)->first();
        $product =Product::where('id',$order_list->product_id)->first();
        $dynamic_name = "Invoice-".$order_info->id."-".Carbon::now()->format('d-m-Y').".pdf";
        $order_pdf = PDF::loadView('customer.download.order',compact('order_info','dynamic_name','order_list','product'));
        // Mail::to(Auth::user()->email)->send(new payment());

       return $order_pdf->download($dynamic_name);


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
