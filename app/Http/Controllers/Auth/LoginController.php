<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $oauthUser = Socialite::driver('github')->user();

        $user = User::where('email', $oauthUser->email)->first();
        // 没有用户，默认创建一个用户
        if (!$user) {
            $user = User::create([
                'name' => $oauthUser->getNickname(),
                'avatar' => $oauthUser->getAvatar(),
                'email' => $oauthUser->getEmail(),
            ]);
        }
        Auth::login($user);
        return Redirect()->guest('/');
    }
}
