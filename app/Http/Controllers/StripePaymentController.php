<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Stripe;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Order_list;
use App\Product;
use App\Cart;
use Str;
use Stripe\Error\Card;
use Stripe\Exception\CardException;
use Exception;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('frontend.onlinepayment');
    }
    public function stripePost(Request $request)
    {


        Stripe\Stripe::setApiKey('sk_test_51I9r4cFnagMfg4BuGoqYfc4nhHP1d99li50IbBX2qmeqFD2NtVdRiUKyPcYnaxE4JdfKr9JXw1a8L7ybZ16jZDZ7007eXTkltZ');
        try {
        Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "Test payment from Catch Food Online"

        ]);

        $order_id = Order::insertGetId([

            'user_id' => Auth::id(),
            'email_address' => $request->email_address,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'note' => $request->note,
            'sub_total' => $request->sub_total,
            'amount' => $request->amount,
            'coupon_name' => $request->coupon_name,
            'payment_method' => 2,
            'status' => 2,
            'currency' => 'BDT',
            'transaction_id' => uniqid(),
            'created_at' => Carbon::now()

        ]);
        // print_r($request->phone_number);
        // die();
                    $url = "http://66.45.237.70/api.php";
                    $number=$request->phone_number;
                    $text="Hello, Dear ".$request->full_name.". Your Transaction Id: ".uniqid().". Total Payment Done: ".$request->amount. " TK,  Thank You";
                    $data= array(
                    'username'=>"01634174881",
                    'password'=>"4RPTBXKF",
                    'number'=>"$number",
                    'message'=>"$text"
                    );

                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                    $p = explode("|",$smsresult);
                    $sendstatus = $p[0];


        // return back();
        foreach(cart_products() as $cart_product){

            Order_list::insert([

            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'product_id' => $cart_product->product_id,
            'amount' =>$cart_product->amount,
            'created_at' => Carbon::now()
            ]);


            Product::find($cart_product->product_id)->decrement('quantity', $cart_product->amount);
            Cart::find($cart_product->id)->delete();

        }
        // $request->session()->flash('message', 'Payment successful!');
        session()->flash('message', 'Payment successful!');
        // return redirect()->action('StripePaymentController@stripe');
        // return redirect('/')->with('message','Payment Done Successfully!');
        return redirect('/');
     }
     catch(\Stripe\Exception\CardException $e) {
        // Since it's a decline, \Stripe\Exception\CardException will be caught
        session()->flash('error', 'Something Wrong, Please check your card number!');
        return redirect('/cart');
        echo 'Status is:' . $e->getHttpStatus() . '\n';
        echo 'Type is:' . $e->getError()->type . '\n';
        echo 'Code is:' . $e->getError()->code . '\n';
        // param is '' in this case
        echo 'Param is:' . $e->getError()->param . '\n';
        echo 'Message is:' . $e->getError()->message . '\n';
      } catch (\Stripe\Exception\RateLimitException $e) {
        // Too many requests made to the API too quickly
      } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Invalid parameters were supplied to Stripe's API
      } catch (\Stripe\Exception\AuthenticationException $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
      } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Network communication with Stripe failed
      } catch (\Stripe\Exception\ApiErrorException $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
      } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
      }

        // return back();

    }

}
