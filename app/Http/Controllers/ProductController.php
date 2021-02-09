<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Product_multiple_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('verified')->except(['show']);
        $this->middleware('checkrole')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = Product::orderBy('id','desc')->paginate(2);
         $total_products =Product::all();
         $categories = Category::all();
         $all_products =Product::count();
         return view('admin.product.index',compact('products','total_products','categories','all_products'));
        //  return view('admin.product.index',[

        //     'categories' => Category::all(),
        //     'products'  => Product::all()
        //  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'product_price' => 'required|numeric|max:1000|min:1',
            'quantity' => 'required|numeric|max:1000|min:1',
            'product_name' => 'required',
            'product_short_desc' => 'required',
            'product_long_desc' => 'required',
            'product_thumbnail_photo' => 'required',
            'product_name' => 'required',


        ]);

        $product_slug =Str::slug($request->product_name.'-'.Carbon::now()->timestamp);
        echo Str::slug('dsadasdas sfsd fdas 33');

       $product_id = Product::insertGetId([

            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'quantity'=>$request->quantity,
            'product_short_desc'=>$request->product_short_desc,
            'product_long_desc'=>$request->product_long_desc,
            'product_thumbnail_photo'=>$request->product_thumbnail_photo,
            'product_slug' =>$product_slug,
            'created_at' => Carbon::now()


        ]);
        //photo upload code
        $uploaded_product_image = $request->file('product_thumbnail_photo');
        $new_product_photo_name =  $product_id.".".$uploaded_product_image->extension();
        $new_product_photo_location = base_path('public/uploads/product_thumbnail/'.$new_product_photo_name);
        Image::make($uploaded_product_image)->resize(600,622)->save($new_product_photo_location,30);

        Product::find($product_id)->update([

            'product_thumbnail_photo' =>$new_product_photo_name,
        ]);
        //photo upload code
        // print_r($request->product_multiple_photos);
        $all_images = $request->file('product_multiple_photos');
        $flag =1;
        foreach($all_images as $single_image){

        $new_product_photo_name =  $product_id."-".$flag.".".$single_image->extension();
        $new_product_photo_location = base_path('public/uploads/product_multiple/'.$new_product_photo_name);
        Image::make($single_image)->resize(600,550)->save($new_product_photo_location);

        Product_multiple_photo::insert([

            'product_id' => $product_id,
            'multiple_photo_name' =>$new_product_photo_name,
            'created_at' => Carbon::now()

        ]);
        $flag++;
        }
        return back()->with('status','Product Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product_info= Product::where('product_slug', $slug)->first();
        $related_products = Product::where('category_id',$product_info->category_id)->where('id','!=',$product_info->id)->get();
        return view('frontend.product_details',compact('product_info','related_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
