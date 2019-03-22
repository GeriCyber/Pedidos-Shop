<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as Req;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Req $request) {

        if($request->has('redirect_to')) {
            session()->put('redirect_to', $request->input('redirect_to'));
        }

        return view('auth.login');
    }

    public function redirectTo() {
        if(session()->has('redirect_to')) {
            return session()->pull('redirect_to');
        }
        return $this->redirectTo;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $fcbUser = Socialite::driver('facebook')->stateless()->user();
        $user = User::where('fcbId', $fcbUser->getId())->first();

        if (!$user) {
            $pass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
            $user = User::create([
            'name' => $fcbUser->getName(),
            'email' => $fcbUser->getEmail(),
            'password' => bcrypt($pass),
            'fcbId' => $fcbUser->getId(),
            ]);
        }

        Auth::login($user, true);
        return redirect($this->redirectTo);
        // return $user->getAvatar();
        // $user->token;
    }
}
