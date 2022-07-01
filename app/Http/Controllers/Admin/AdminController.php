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
use Illuminate\Support\Facades\Storage;
use File;
use PDF;

class AdminController extends Controller
{
    public function show()
    {          
        $users = User::where('break', 'on')->get();
        return view('pages.admin.manage', compact('users'));
    }

    public function managePost(Request $request)
    {
        foreach ($request->id as $id) {
            $users = User::where('id', $id)->get();
            if($users[0]->status != $request->input('status_'.$id)) {
                if($request->file('doc_'.$id)) {
                    $mytime = Carbon::now();
                    $fileName = $request->file('doc_'.$id)->getClientOriginalName().'('.$mytime->toDateTimeString().')';
                    $filePath = public_path().'/uploads';
                    $request->file('doc_'.$id)->move($filePath, $fileName);
                    User::where('id', $id)->update(array('doc_url' => $filePath));
                    User::where('id', $id)->update(array('doc' => $fileName));
                }
                User::where('id', $id)->update(array('release_url' => $request->input('release_url_'.$id)));
                User::where('id', $id)->update(array('status' => $request->input('status_'.$id)));
                if($request->input('status_'.$id) == "契約書") {
                    $subject = new SendGrid\Mail\Subject('【業務提携契約締結のご連絡】foriio Benefits');
                    $data = "会社名：".$users[0]->company."<br>担当者名：".$users[0]->person."様<br><br>foriio Benefitsの業務提携契約が締結されました。<br><br>次は、foriio Benefitsの特典内容を以下よりご入力願います。<br><br>foriio Benefitsの特典内容のご入力はこちら<br><br>URL：<a href='".URL::to('/')."/benefit'>".URL::to('/')."/benefit</a><br><br>【foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com";
                }
                else if($request->input('status_'.$id) == "Benefits") {
                    $subject = new SendGrid\Mail\Subject('【特典内容のご連絡】foriio Benefits');
                    $data = "会社名：".$users[0]->company."<br>担当者名：".$users[0]->person."様<br><br>foriio Benefitsに掲載する特典の内容をお送りいただきありがとうございます。<br>いただいた情報を元に掲載の準備を進めます。<br><br><foriio Benefits特典内容はこちら〉<br>URL: <a href='https://www.foriio.com/benefits'>https://www.foriio.com/benefits</a><br><br>プレスリリース公開日の希望日の選択をお願いいたします。<br>遷移先URL:<a href='#'></a><br><br>【foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com";
                }
                else if($request->input('status_'.$id) == "プレスリリース日決定") {
                    $subject = new SendGrid\Mail\Subject('【確認依頼のご連絡】プレスリリースの原稿をお送りいたしました。');
                    $data = "会社名：".$users[0]->company."<br>担当者名：".$users[0]->person."様<br><br>forii〇から配信されるプレスリリースの原稿をお送りいたしますのでご確認下さい。<br>URL: <a href='".URL::to('/')."/report'>".URL::to('/')."/report</a><br><br>【foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com";
                }
                else if($request->input('status_'.$id) == "プレスリリース原稿") {
                    $subject = new SendGrid\Mail\Subject('【承認のご連絡】プレスリリース受付を完了いたしました。');
                    $data = "会社名：".$users[0]->company."<br>担当者名：".$users[0]->person."様<br><br>プレスリリースの原稿をご承認いただきありがとうございます。<br>これよりプレスリリースの配信準備に取り掛かりますのでよろしくお願いいたします。<br><br>事業者様のプレスリリースが完成しましたら、配信前にforiio側で確認させて頂きたく思いますので、以下のメールアドレス宛に添付でお送りください。<br>※配信希望日の1週間前までに以下のメールアドレス宛にお送りください。<br><br>【foriio Benefitsに関するお問い合わせ先】<br>株式会社foriio<br>担当者:foriio Benefits担当窓口<br>mail : benefit@foriio.com";
                }
                $from = new SendGrid\Mail\From(getenv('MAIL_FROM_ADDRESS'));
                $to = new SendGrid\Mail\To($users[0]->email);
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
            }
        }
        toastr()->success('正常に保存されました。','',config('toastr.options'));
        $users = User::orderBy('id', 'desc')->get();
        return response()->json(['success'=>'正常に保存されました。', 'result'=>$users]);
    }
}