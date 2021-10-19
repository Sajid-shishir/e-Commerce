<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Faq;
use Illuminate\Support\Carbon;
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

        $faqs_frontend = Faq::all();
        return view('frontend.faq',compact('faqs_frontend'));
    }

    function faq_post(){

        $faqs = Faq::all();
        return view('admin.faq.index',compact('faqs'));
    }

    function faq_delete($faq_id){

        Faq::find($faq_id)->delete();
         return back()->with('deleteStatus','Deleted Successfully');

    }

    function faq_edit($faq_id){

         $faq = Faq::find($faq_id);
        return view('admin.faq.edit',compact('faq'));

        // Faq::find($faq_id)->delete();
        //  return back()->with('deleteStatus','Deleted Successfully');

    }
    function faq_edit_post(Request $request){



        Faq::find($request->faq_id)->update([
            'faq_question' =>$request->faq_question,
            'faq_answer' =>$request->faq_answer,
        ]);
          return redirect('faq_post')->with('UpdateStatus','Updated Successfully');

    }

    function faq_add(Request $request){

        $request->validate([
            'faq_question' => 'required|unique:faqs,faq_question',
            'faq_answer' => 'required',

        ]);

        Faq::insert([
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer,
            'created_at' => Carbon::now()
        ]);
            return back()->with('status','FAQ Added Successfully');

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
