<?php

namespace App\Http\Controllers;

use App\Order;
use App\City;
use App\Order_list;
use App\Cart;
use App\Country;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Library\SslCommerz\SslCommerzNotification;
use Str;

class CheckoutController extends Controller
{
    function __construct(){

        $this->middleware('auth');
    }
    function index(Request $request){

        return view('frontend.checkout',[

            'total_from_cart' => $request->total_from_cart,
            'coupon_from_cart' => $request->coupon_from_cart,
            'discount_amount' => $request->discount_amount,
            'countries' => Country::all()
        ]);
    }
    function checkoutpost(Request $request){
        if($request->payment_method == 1){

            $order_id = Order::insertGetId($request->except('_token')+[

                'user_id' => Auth::id(),
                'transaction_id' => Str::random(15),
                'created_at' => Carbon::now()
            ]);

            // inserting in order_list table
            foreach(cart_products() as $cart_product){

                Order_list::insert([

                'user_id' => Auth::id(),
                'order_id' => $order_id,
                'product_id' => $cart_product->product_id,
                'amount' =>$cart_product->amount,
                'created_at' => Carbon::now()
                ]);
                    // emptying cart table
                Product::find($cart_product->product_id)->decrement('quantity', $cart_product->amount);
                Cart::find($cart_product->id)->delete();

            }
                return redirect('/');
        }
        // elseif($request->payment_method == 3){
        //     return view('frontend.bkash',[
        //         'full_name' =>$request->full_name,
        //         'email_address' =>$request->email_address,
        //         'phone_number' =>$request->phone_number,
        //         'country_id' =>$request->country_id,
        //         'city_id' =>$request->city_id,
        //         'address' =>$request->address,
        //         'note' =>$request->note,
        //         'sub_total' =>$request->sub_total,
        //         'total' =>$request->total,
        //         'coupon_name' =>$request->coupon_name

        //     ]);
        // }
        else{
            // echo "credit card";
            // print_r($request->all());
            return view('frontend.onlinepayment',[
                'full_name' =>$request->full_name,
                'email_address' =>$request->email_address,
                'phone_number' =>$request->phone_number,
                'country_id' =>$request->country_id,
                'city_id' =>$request->city_id,
                'address' =>$request->address,
                'note' =>$request->note,
                'sub_total' =>$request->sub_total,
                'amount' =>$request->amount,
                'coupon_name' =>$request->coupon_name

            ]);

        }
        // inserting in order table

    }
    
    function getcitylist(Request $request){
        $drop_to_send = "";

        $cities =City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $drop_to_send .="<option value='".$city->id."'>".$city->city_name."</option>";
        }
        echo $drop_to_send;
    }



}
