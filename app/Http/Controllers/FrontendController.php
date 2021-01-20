<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class FrontendController extends Controller
{
    function index(){
         return view('frontend.index',[

            'categories' => Category::all(),
            // 'products'   => Product::orderBy('id','desc')->get()
            'products'   => Product::latest()->get()
         ]);

    }

    function contact(){

        return view('frontend.contact');
    }

    function faq(){

        return view('frontend.faq');
    }

    function about(){

        return view('frontend.about',[
            'categories' => Category::all()
        ]);
    }

    function shop(){

        return view('frontend.shop',[

            'products' =>Product::all(),
            'categories' =>Category::all()
        ]);
    }
    function search(){

        $searched_products = QueryBuilder::for(Product::class)
               ->allowedFilters(['product_name','category_id'])
               ->get();
               return view('frontend.search', compact('searched_products'));
    }
}
