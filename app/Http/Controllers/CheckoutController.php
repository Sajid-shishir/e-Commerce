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
        elseif($request->payment_method == 3){
            return view('frontend.bkash',[
                'full_name' =>$request->full_name,
                'email_address' =>$request->email_address,
                'phone_number' =>$request->phone_number,
                'country_id' =>$request->country_id,
                'city_id' =>$request->city_id,
                'address' =>$request->address,
                'note' =>$request->note,
                'sub_total' =>$request->sub_total,
                'total' =>$request->total,
                'coupon_name' =>$request->coupon_name

            ]);
        }
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
                'total' =>$request->total,
                'coupon_name' =>$request->coupon_name

            ]);

        }
        // inserting in order table

    }
    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
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
