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

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('frontend.onlinepayment');
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51I9r4cFnagMfg4BuGoqYfc4nhHP1d99li50IbBX2qmeqFD2NtVdRiUKyPcYnaxE4JdfKr9JXw1a8L7ybZ16jZDZ7007eXTkltZ');

        Stripe\Charge::create ([
                "amount" => $request->total * 100,
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
            'total' => $request->total,
            'coupon_name' => $request->coupon_name,
            'payment_method' => 2,
            'paid_status' => 2,
            'created_at' => Carbon::now()

        ]);

        // return back();
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
        // $request->session()->flash('message', 'Payment successful!');
        session()->flash('message', 'Payment successful!');
        // return redirect()->action('StripePaymentController@stripe');
        // return redirect('/')->with('message','Payment Done Successfully!');
        return redirect('/');
        // return back();

    }

}
