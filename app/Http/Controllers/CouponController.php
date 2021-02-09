<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;
use App\Mail\SendCoupon;
use App\User;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupon.index',[

            'coupons' =>Coupon::all()
        ]);
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

            'coupon_name' => 'required|max:20|unique:coupons,coupon_name',
            'discount_amount' => 'required|numeric|max:99|min:1',
            'valid_till' => 'required'
        ]);

        Coupon::insert([

            'coupon_name' => strtoupper($request->coupon_name),
            'discount_amount' => $request->discount_amount,
            'valid_till' => $request->valid_till,
            'created_at' =>Carbon::now()

        ]);
          $coupon_name = strtoupper($request->coupon_name);
        foreach(User::where('role',2)->get() as $user){

            Mail::to($user->email)->send(new SendCoupon($coupon_name));
        }

        return back()->with('status','Coupon Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
