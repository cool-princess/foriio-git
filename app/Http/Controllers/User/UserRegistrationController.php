<?php

namespace App\Http\Controllers\User;

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
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class UserRegistrationController extends Controller
{
    public function show()
    {          
        return view('auth.user.register');
    }

    public function store(Request $request)
    {
        $q_result = DB::table('users')->select('email')->get();
        foreach ($q_result as $value) {
            if($value->email == $request->email) {
                return response()->json(['success'=>'すでに登録されているメールです。']);
            }
        }

        $user = User::create([
            'password' => bcrypt($request->password),
            'company' => $request->company,
            'person' => $request->person,
            'email' => $request->email,
            'pwd_store' => $request->password
        ]);
        
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($request->email);
        $subject = new SendGrid\Mail\Subject('【仮登録完了のご連絡】foriio Creator Matchアカウント発行');
        

        $data = "会社名：".$request->company."<br>担当者名：".$request->person."<br><br>foriio Creator Matchの仮登録が完了いたしました。<br>現段階では本登録は完了しておりません。<br>下記URLから本登録を完了してください。<br>よろしくお願いいたします。<br><br>URL：<a href='".Route('userRegisterComplete', ['company' => $request->company, 'person' => $request->person, 'email' => $request->email])."'>http://localhost:8000/register_complete</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
        
        $htmlContent = new SendGrid\Mail\HtmlContent($data);
        

        $email = new SendGrid\Mail\Mail(
            $from,
            $to,
            $subject,
            null,
            $htmlContent
        );

        $sendgrid = new SendGrid(getenv('MAIL_PASSWORD'));
        $response = $sendgrid->send($email);

        $admin_from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $admin_to = new SendGrid\Mail\To(getenv('MAIL_FROM_ADDRESS'));
        $admin_subject = new SendGrid\Mail\Subject('【仮登録完了】foriio Creator Matchアカウント発行');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$request->company."<br>担当者名：".$request->person."<br>メールアドレス：".$request->email."<br>日時：".$mytime->toDateTimeString()."<br><br>小野朋花";
        
        $admin_htmlContent = new SendGrid\Mail\HtmlContent($admin_data);
        

        $admin_email = new SendGrid\Mail\Mail(
            $admin_from,
            $admin_to,
            $admin_subject,
            null,
            $admin_htmlContent
        );

        $admin_sendgrid = new SendGrid(getenv('MAIL_PASSWORD'));
        $admin_response = $admin_sendgrid->send($admin_email);

        return response()->json(['success'=>'仮登録に成功しました。']);
    }

    public function complete(Request $request)
    {
        $admin_email = $request->email;
        $admin_company = $request->company;
        $admin_person = $request->person;
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject_complete = new SendGrid\Mail\Subject('【本登録完了のご連絡】foriio Creator Matchアカウント発行');
        $data_complete = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>ご登録ありがとうございます。<br><br>foriio Creator Matchの登録が完了いたしましたので、<br>次はforiio Benefits掲載に向けた業務提携契約をお願いいたします。<br>業務提携契締結はこちら<br><br>URL：<a href='http://localhost:8000/contract'>http://localhost:8000/contract</a><br><br>foriio Creator Matchはこちら<br>URL：<a href='https://creatormatch.foriio.com'>https://creatormatch.foriio.com</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
        $htmlContent_complete = new SendGrid\Mail\HtmlContent($data_complete);
        $email_complete = new SendGrid\Mail\Mail(
            $from,
            $to,
            $subject_complete,
            null,
            $htmlContent_complete
        );

        $sendgrid_complete = new SendGrid(getenv('MAIL_PASSWORD'));
        $response_complete = $sendgrid_complete->send($email_complete);

        $admin_from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
    
        $admin_to = new SendGrid\Mail\To(getenv('MAIL_FROM_ADDRESS'));
        $admin_subject = new SendGrid\Mail\Subject('【本登録完了】foriio Creator Matchアカウント発行');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>小野朋花";
        
        $admin_htmlContent = new SendGrid\Mail\HtmlContent($admin_data);
        
        $admin_email = new SendGrid\Mail\Mail(
            $admin_from,
            $admin_to,
            $admin_subject,
            null,
            $admin_htmlContent
        );

        $admin_sendgrid = new SendGrid(getenv('MAIL_PASSWORD'));
        $admin_response = $admin_sendgrid->send($admin_email);
        return view('auth.user.register_complete');
    }
}