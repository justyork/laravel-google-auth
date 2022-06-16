<?php

namespace JustYork\LaravelGoogleAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
//use Backpack\CRUD\app\Library\Auth\AuthenticatesUsers;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        try {
            $user = Socialite::driver($social)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== env("ALLOWED_DOMAIN")){
            return redirect()->to('/');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                        = new User;
            $newUser->name                  = $user->name;
            $newUser->email                 = $user->email;
            $newUser->{"{$social}_id"}      = $user->id;
            $newUser->avatar                = $user->avatar;
            $newUser->avatar_original       = $user->avatar_original;
            $newUser->api_token = Str::random(60);
            $newUser->save();

            $newUser->assignRole(Role::findByName('ua'));
            auth()->login($newUser, true);
        }

        return redirect()->to(session()->get('url.intended') ?? '/');
    }


    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

}
