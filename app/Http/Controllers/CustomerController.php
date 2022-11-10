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
       


    //    $customer_orders = Order::with(['city','user'])->where('user_id',Auth::id())->orderBy('id','desc')->get();
    //    $customer_orders = Order::with(['city','user'])->join('users','orders.user_id','=','users.id')
                        //   ->get(['users.*', 'orders.currency']);
    //    $customer_orders =Order::all();
    
    $customer_orders = Order::where('user_id',Auth::id())->orderBy('id','desc')->paginate(5);
    $product_info = Order_list::where('product_id')->get();
    return view('customer.home',compact('customer_orders','product_info'));
        // $product_info = Order_list::all();
        // return view('customer.home',compact('customer_orders'));
        // return $customer_orders->toJson();
        // $array = json_decode($customer_orders, true);
//  create a new collection instance from the array
    //   return collect($array);
        // return response()->json($customer_orders);
    }

    function orderdownload($order_id){

       $order_info = Order::findOrFail($order_id);
        $order_list = Order_list::select('id','order_id', 'product_id','amount')->where('order_id',$order_id)->get();
        $data=[];
        $data2=[];
        $i=0;
        foreach($order_list as $v){
            $data[$i]=$v->product_id;
            $data2[$i]=$v->amount;
            $i++;


       $order_list = Order_list::where('order_id',$order_id)->first();
       $product =Product::where('id',$order_list->product_id)->first();

        }
        $product=[];
        $price=[];

        for($j=0;$j<count($data);$j++){

            $product[$j] =Product::where('id',$data[$j])->value('product_name');

            $price[$j] =Product::where('id',$data[$j])->value('product_price');


        }
        // $result = array_merge($data, $data2);

        // return $data;

        // $product =Product::where('id',$order_list->product_id)->value();

        //   return view('customer.download.order',compact('product'));

        $dynamic_name = "Invoice-".$order_info->id."-".Carbon::now()->format('d-m-Y').".pdf";
        $order_pdf = PDF::loadView('customer.download.order',compact('order_info','dynamic_name','product','price','data2','order_list'));
        // Mail::to(Auth::user()->email)->send(new payment());

       return $order_pdf->download($dynamic_name);


    }

    function addreview(Request $request){

        $request->validate([
            'review' =>'required',
            'star' =>'required'
        ]);

        // print_r($request->all());
        $order_list =Order_list::where('user_id',Auth::id())->where('product_id',$request->product_id)->whereNull('review')->first()->update([
            'review' =>$request->review,
            'star' =>$request->star

        ]);
        return back();

    }
}
