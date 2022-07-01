<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\MessageBag;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\URL;

class LogInController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->redirectTo = URL::previous();
    }

    public function showUserLoginForm()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.user.login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            if($request->remember===null){
                setcookie('login_email',$request->email,100);
                setcookie('login_pass',$request->password,100);
            }
            else{
                setcookie('login_email',$request->email,time()+60*60*24*100);
                setcookie('login_pass',$request->password,time()+60*60*24*100);
 
            }
            if(!is_null($_COOKIE['cur_url']))
                return redirect($_COOKIE['cur_url']);
            else
                return redirect('/contract');
        }else{
            $errors = new MessageBag(['email' => ['ログイン情報が正しくありません。']]);
            return back()->withErrors($errors)->withInput($request->only('email', 'remember'));
        }
    }

    public function showAdminLoginForm()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            if($request->remember===null){
                setcookie('login_email',$request->email,100);
                setcookie('login_pass',$request->password,100);
            }
            else{
                setcookie('login_email',$request->email,time()+60*60*24*100);
                setcookie('login_pass',$request->password,time()+60*60*24*100);
 
            }
            return redirect('/admin');
        }else{
            $errors = new MessageBag(['email' => ['ログイン情報が正しくありません。']]);
            return back()->withErrors($errors)->withInput($request->only('email', 'remember'));
        }
    }
}
