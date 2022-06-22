<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\MessageBag;
use App\Models\Message;
use App\Jobs\MailSend;
use Validator;
use SendGrid;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function show()
    {          
        return view('auth.admin.register');
    }

    public function store(Request $request)
    {
        $q_result = DB::table('admin')->select('email')->get();
        foreach ($q_result as $value) {
            if($value->email == $request->email) {
                return response()->json(['success'=>'すでに登録されているメールです。']);
            }
        }

        $user = Admin::create([
            'password' => bcrypt($request->password),
            'company' => $request->company,
            'person' => $request->person,
            'email' => $request->email,
            'pwd_store' => $request->password
        ]);

        return response()->json(['success'=>'登録に成功しました。']);
    }
}