<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use App\Notifications\TwoFactorCode;

class TwoFactorController extends Controller
{
   public function __construct()
   { $this->middleware(['auth','twofactor']);}
   public function index()
   {
     return view('auth.verify');
  }
   public function store(Request $request)
   {
    $request->validate([
        'two_factor_code' => 'integer|required',
    
    ]);
    $user = auth()->user();
    if($request->input('two_factor_code')== $user->two_factor_code){
        $user->resetTwoFactorCode();
        
        return redirect()->route('home');
    }
    return redirect()->back()->withError(['two_factor_code'=> 'the two factor code you have entreed does not match']);
   }

 
    public function resend()
{
    $user = auth()->user();
    $user->generateTwoFactorCode();
    $user->notify(new TwoFactorCode());
    return redirect()->back()->withMessage('the two factor code has been sent again');
}
    
    
    
    
    
}
