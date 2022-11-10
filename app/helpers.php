<?php

use Illuminate\Support\Facades\DB;

        function cart_total_products(){

            return App\Cart::where('ip_address', request()->ip())->count();
        }

        function cart_products(){

             return App\Cart::where('ip_address', request()->ip())->get();
//            return App\Cart::where('id')->first();

        }
        function itemlist(){

            // return App\Order_list::all();
            return $item_list = DB::table('order_lists')
                    ->join('products', 'order_lists.order_id', '=', 'products.id')
                    ->get();


        }

    function sub_total(){

            $total_price = 0;
            foreach(cart_products() as $cart_product){
                $total_price = $total_price + ($cart_product->amount * App\Product::find($cart_product->product_id)->product_price);

            }

                return $total_price;
    }

        function orderinfo(){

            return App\Order_list::where('product_id',request())->get();
        }

    function review_star_amount($product_id){
            if(!App\Order_list::where('product_id',$product_id)->exists()){
            return 0;
             }


             else{
                 $star_amount = (App\Order_list::where('product_id',$product_id)->where('star','!=',0)->sum('star')) / (App\Order_list::where('product_id',$product_id)->where('star','!=',0)->count());
                return ceil($star_amount);
                }
        }


