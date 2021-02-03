<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordForm;
use App\Mail\ChangePasswordConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Charts\WeeklySaleChart;
use App\Charts\PaymentMethodChart;
use App\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole')->except(['edit_profile','change_password']);
    }

    /**
     * Show the application dashboard.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        for($i=1; $i<=7 ;$i++){
            $date[] = Carbon::now()->subDays(7-$i)->format('Y-m-d');
            $sale[] = Order::whereDate('created_at',Carbon::now()->subDays(7-$i)->format('Y-m-d'))->sum('amount');
        }

            $weekly_chart = new WeeklySaleChart;
            $weekly_chart->labels($date);
            $weekly_chart->dataset('Sale','bar', $sale)->options([
                'backgroundColor' => [


                ]
            ]);
            // $weekly_chart->dataset('Sample 2','pie', [3, 2, 1]);

                $cash_on_delivery = Order::where('payment_method',1)->count();
                $online_payment   = Order::where('payment_method',2)->count();
                $ssl_payment   = Order::where('payment_method',3)->count();
                $Payment_method_chart = new PaymentMethodChart;
                $Payment_method_chart->labels(['Cash On Delivery','Online Payment','ssl_payment']);
                $Payment_method_chart->dataset('Payment Type','pie', [$cash_on_delivery,$online_payment,$ssl_payment])->options([
                    'backgroundColor' => [
                        '#5B93D3',
                        '#5B9387',
                    ]
                ]);

        $users = User::orderBy('id','desc')->paginate(3);
        $total_users=User::count();
        return view('home',compact('users','total_users','weekly_chart','Payment_method_chart'));

    }
    public function edit_profile(){

        return view('admin.edit_profile');
    }

    public function change_password( ChangePasswordForm $request ){

        if($request->Old_password == $request->password){

            return back()->withErrors('New password cannot be your old password!');
        }

        $old_password = $request->old_password;
        $db_password = Auth::user()->password;
        if(Hash::check($old_password,$db_password)){

             User::find(Auth::id())->update([

                 'password'=>Hash::make($request->password)
             ]);
             //email start
            Mail::to($request->user())->send(new ChangePasswordConfirmation());
            //email end
             return back()->with('password_change_success','Password changed successfully');
        }
        else{
            return back()->withErrors('Your old password doesnt match!');

        }
        //print_r($request->all());

    }
    public function report(){
            return view('admin.report');
    }
}
