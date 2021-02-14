<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
class GithubController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        if(!User::where('email', $user->getEmail())->exists()){
            User::insert([
                'name' => $user->getNickname(),
                'email' => $user->getEmail(),

                'password' => bcrypt('xyz@123'),
                'role' => 2,
                'created_at' => Carbon::now()
            ]);
        }
        if(Auth::attempt(['email'=> $user->getEmail(), 'password' => 'xyz@123'])) {

            return redirect('home/customer');
        }


        // $user->token;
    }
}
