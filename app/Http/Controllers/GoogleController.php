<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        if(!User::where('email', $user->getEmail())->exists()){
            User::insert([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' =>'null',
                'password' => bcrypt('xyz@123'),
                'role' => 2,
                'created_at' => Carbon::now(),
            ]);
        }
        if(Auth::attempt(['email'=> $user->getEmail(),'password' => 'xyz@123'])){

         return redirect('home/customer');
        }

        // $user->token;
    }
}
