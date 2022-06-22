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
use App\Models\Admin;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function show()
    {   
        if(Auth::guard('user')->check())
            return view('pages.user.contract');
        else
            return redirect('/login');
    }

    public function confirm()
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【業務提携契約締結のご連絡】foriio Benefits');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>foriio Benefitsの業務提携契約が締結されました。<br>契約書を添付しておりますのでご確認ください。<br><br>次は、foriio Benefitsの特典内容を以下よりご入力願います。<br><br>foriio Benefitsの特典内容のご入力はこちら<br><br>URL：<a href='http://localhost:8000/benefit'>http://localhost:8000/benefit</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【業務提携契約締結】foriio Benefits');
        
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
        toastr()->success('foriio Benefitsの業務提携契約が締結されました。','',config('toastr.options'));
        return view('pages.user.contract_complete');
    }

    public function benefit()
    {         
        if(Auth::guard('user')->check())
            return view('pages.user.benefit');
        else
            return redirect('/login'); 
    }

    public function quiz(Request $request)
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【質問•修正依頼送信のご連絡】foriio Benefits提携契約');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>お問い合わせありがとうございます。<br>foriioよりメールにて回答させていただきます。<br><br>回答につきましては時間を要する場合がございますので、次のステップへお進みください。<br>あらかじめご了承いただきますようお願いいたします。<br><br>〈お問い合わせ内容はこちら〉<br><br>URL：<a href=''>ダミーダミーダミー</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【頃問•修正依頼入カフォーム】 foriio Benefits提携契約書');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈質問はこちら〉<br><a href='http://localhost:8000/contract'>http://localhost:8000/contract</a><br><br>小野朋花";
        
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
        toastr()->success('質問内容が送信されました。','',config('toastr.options'));
        return response()->json(['success'=>'質問内容が送信されました。']);
    }

    public function benefitPost()
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【特典内容のご連絡】foriio Benefits');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>foriio Benefitsに掲載する特典の内容をお送りいただきありがとうございます。<br>いただいた情報を元に掲載の準備を進めます。<br><br><foriio Benefits特典内容はこちら〉<br>ダミーダミーダミー<br><br>プレスリリース公開日の希望日の選択をお願いいたします。<br>遷移先URL:<a href='#'></a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【特典内容】foriio Benefits');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈特典内容はこちら〉<br><a href='https://www.foriio.com/benefits'>https://www.foriio.com/benefits</a><br><br>小野朋花";
        
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
        toastr()->success('特典内容が送信されました。','',config('toastr.options'));
        return response()->json(['success'=>'特典内容が送信されました。']);
    }

    public function benefit_quiz(Request $request)
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【質問送信のご連絡】foriio Benefits');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>お問い合わせありがとうございます。<br>foriioよりメールにて回答させていただきます。<br><br>回答につきましては時間を要する場合がございますので、次のステップへお進みください。<br>あらかじめご了承いただきますようお願いいたします。<br><br>〈お問い合わせ内容はこちら〉<br><br>URL：<a href=''>ダミーダミーダミー</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【質問入カフォー厶】foriio Benefits');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈質問はこちら〉<br><a href='http://localhost:8000/benefit'>http://localhost:8000/benefit</a><br><br>小野朋花";
        
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
        toastr()->success('質問が送信されました。','',config('toastr.options'));
        return response()->json(['success'=>'質問が送信されました。']);
    }

    public function desire_date()
    {
        if(Auth::guard('user')->check())
            return view('pages.user.desire_date');
        else
            return redirect('/login'); 
    }

    public function datePost(Request $request)
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【配信希望日のご連絡】foriio Benefits及びプレスリリース');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>foriio Benefits及びプレスリリースの配信日の希望をお送りいただきありがとうございます。<br><br>〈配信希望日はこちら〉<br>foriio Benefits掲載希望日:".$request->desire_date."<br>プレスリリース配信希望日:".$request->delivery_date."<br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【配信希望日】foriio Benefits及びプレスリリース');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈掲載•配信希望日はこちら〉<br>".$request->desire_date."（掲載•酉己信希望日URL）<br><a href='http://localhost:8000/desire_date'>http://localhost:8000/desire_date</a><br><br>小野朋花";
        
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
        return response()->json(['success'=>'配信希望日が送信されました。']);
    }

    public function report()
    {
        if(Auth::guard('user')->check())
            return view('pages.user.report');
        else
            return redirect('/login'); 
    }

    public function reportPost(Request $request)
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【承認のご連絡】プレスリリース受付を完了いたしました。');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>プレスリリースの原稿をご承認いただきありがとうございます。<br>これよりプレスリリースの配信準備に取り掛かりますのでよろしくお願いいたします。<br><br>事業者様のプレスリリースが完成しましたら、配信前にforiio側で確認させて頂きたく思いますので、以下のメールアドレス宛に添付でお送りください。<br>※配信希望日の1週間前までに以下のメールアドレス宛にお送りください。<br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【事業者承認】プレスリリース');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈掲載•酉己信希望日はこちら〉<br><a href='http://localhost:8000/desire_date'>http://localhost:8000/desire_date</a><br><br>小野朋花";
        
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
        return response()->json(['success'=>'配信希望日が送信されました。']);
    }

    public function report_quiz(Request $request)
    {
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【質問送信のご連絡】プレスリリース');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>お問い合わせありがとうございます。<br>foriioよりメールにて回答させていただきます。<br><br>回答につきましては時間を要する場合がございますので、次のステップへお進みください。<br>あらかじめご了承いただきますようお願いいたします。<br><br>〈お問い合わせ内容はこちら〉<br><br>URL：<a href=''>ダミーダミーダミー</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        $admin_subject = new SendGrid\Mail\Subject('【質問入カフォーム】プレスリリース');
        
        $mytime = Carbon::now();
        
        $admin_data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br>メールアドレス：".$admin_email."<br>日時：".$mytime->toDateTimeString()."<br><br>〈質問はこちら〉<br><a href='http://localhost:8000/desire_date'>http://localhost:8000/desire_date</a><br><br>〈掲載•配信希望日はこちら〉<br><a href='http://localhost:8000/desire_date'>http://localhost:8000/desire_date</a><br><br>小野朋花";
        
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
        toastr()->success('質問が送信されました。','',config('toastr.options'));
        return response()->json(['success'=>'質問が送信されました。']);
    }

    public function all_complete()
    {
        if(Auth::guard('user')->check())
            return view('pages.user.all_complete');
        else
            return redirect('/login'); 
    }

    public function manage()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('pages.admin.manage', compact('users'));
    }

    public function managePost(Request $request)
    {
        foreach ($request->id as $id) {
            if($request->file('doc_'.$id)) {
                $fileName = $request->file('doc_'.$id)->getClientOriginalName();
                $filePath = $request->file('doc_'.$id)->storeAs('uploads', $fileName, 'public');
                if($product->isDirty('price'))
                User::where('id', $id)->update(array('doc_url' => '/storage/app/public/' . $filePath));
                User::where('id', $id)->update(array('doc' => $fileName));
            }
            User::where('id', $id)->update(array('release_url' => $request->input('release_url_'.$id)));
            User::where('id', $id)->update(array('status' => $request->input('status_'.$id)));
        }
        $admin_email = Auth::guard('user')->user()->email;
        $admin_company = Auth::guard('user')->user()->company;
        $admin_person = Auth::guard('user')->user()->person;
  
        $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
        
        $to = new SendGrid\Mail\To($admin_email);
        $subject = new SendGrid\Mail\Subject('【確認依頼のご連絡】プレスリリースの原稿をお送りいたしました。');

        $data = "会社名：".$admin_company."<br>担当者名：".$admin_person."<br><br>foriioから酉己信されるプレスリリースの原稿をお送りいたしますのでご確認下さい。<br>URL：<a href='http://localhost:8000/report'>http://localhost:8000/report</a><br><br>[foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com<br><br>小野朋花";
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
        toastr()->success('正常に保存されました。','',config('toastr.options'));
        $users = User::orderBy('id', 'desc')->get();
        return response()->json(['success'=>'正常に保存されました。']);
    }
}