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
     function index(){

        $blog_frontend =Blog::latest()->get();
        return view('frontend.blog',compact('blog_frontend'));
    }

     function blog_post(){

        $blogs =Blog::orderBy('id','desc')->paginate(3);
        $total_blogs=Blog::count();
        // $blogs =Blog::all();
        return view('admin.blog.index',compact('blogs','total_blogs'));
    }

     function blog_add(Request $request){

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

     function blog_show($blog_id){

        $blog_details = Blog::all();
        $blog_info = Blog::find($blog_id);
        $related_blogs = Blog::where('id','!=',$blog_info->id)->get();
        return view('frontend.blog_details',compact('blog_info','blog_details','related_blogs'));
    }

    function blog_edit($blog_id){

        $blog = Blog::find($blog_id);
        return view('admin.blog.edit',compact('blog'));

    }


    function blog_edit_post(Request $request){

        Blog::find($request->blog_id)->update([
            'blog_title' =>$request->blog_title,
            'desc' =>$request->desc,
        ]);
          return redirect('blog_post')->with('UpdateStatus','Updated Successfully');
    }

    function blog_delete($blog_id){

        Blog::find($blog_id)->delete();
         return back()->with('deleteStatus','Deleted Successfully');

    }

}
