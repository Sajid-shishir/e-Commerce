<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Session\Session;

class BlogController extends Controller
{
    public function index(){

        $blog_frontend =Blog::all();
        return view('frontend.blog',compact('blog_frontend'));
    }

    public function blog_post(){
        $blogs =Blog::all();
        return view('admin.blog.index',compact('blogs'));
    }

    public function blog_add(Request $request){

        $request->validate([
            'blog_title'=>'required|unique:blogs,blog_title',
            'desc'=>'required',
            'image'=>'required',
        ]);
       $blog_create = Blog::create([
            'blog_title'=>$request->blog_title,
            'desc'=>$request->desc,
            'blog_added_by'=>Auth::id(),
            'created_at' => Carbon::now()
        ]);
        if($request->hasFile('image')){
            $uploaded_blog_image = $request->file('image');
            $new_blog_image_name = $blog_create->id.".".$uploaded_blog_image->extension();
            $new_blog_image_location = base_path('public/uploads/blog/'.$new_blog_image_name);
            Image::make($uploaded_blog_image)->resize(600,470)->save($new_blog_image_location,30);

            $blog_create->image = $new_blog_image_name;
            $blog_create->save();
        }
        return back()->with('status','Blog Added Successfuly!!!');
        // return view('admin.blog.index');
    }

    public function blog_show($blog_id){

        $blog_details = Blog::all();
        $blog_info = Blog::find($blog_id);
        $related_blogs = Blog::where('id','!=',$blog_info->id)->get();
        return view('frontend.blog_details',compact('blog_info','blog_details','related_blogs'));
    }
}
