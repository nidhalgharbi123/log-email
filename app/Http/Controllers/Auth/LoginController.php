<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\TwoFactorCode;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use DB;
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
    protected function authenticated(Request $request, $user)
     {
    //     $activityLog = [
    //         'user_id' => $user->id,
    //         'name' => $user->email,
    //         'email' => $user->email,
    //         'description' => 'log in',
    //         'date_time' => now(),
    //         'ip_address' => $request->ip(),
    //     ];
    
    //     DB::table('activity_logs')->insert($activityLog);
    
        if ($user->two_factor_code_verified_at) {
            return redirect()->route('layouts.dash');
        }else{
    
        return redirect()->route('auth.verify');
        }}
    
    public function logout(Request $request)
    {
        // Enregistrer le journal d'activité (décommentez le code si nécessaire)
        // $user = Auth::user();
        // $activityLog = [
        //     'user_id' => $user->id,
        //     'name' => $user->name,
        //     'email' => $user->email,
        //     'description' => 'log out',
        //     'date_time' => now(),
        //     'ip_address' => $request->ip(),
        // ];
        // DB::table('activity_logs')->insert($activityLog);
    
        Auth::logout();
        return redirect('login');
    }
    
}    