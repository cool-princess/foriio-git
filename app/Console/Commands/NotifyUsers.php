<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Carbon\Carbon;
use App\Jobs\MailSend;
use App\Models\User;
use SendGrid;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = date("Y-m-d H:i", strtotime(Carbon::now()));
        logger($now);
        $messages = Message::get();
        if($messages !== null){
            $messages->where('reserve_date',  $now)->each(function($message) {
                if($message->delivered == '予')
                {
                    preg_match_all("/\[([^\]]*)\]/", $message->body, $matches);
                    $data = array();
                    $patterns = array();
                    $j = 0;
                    $code_number = count($matches[1]);
                    if($code_number) {
                        foreach ($message->to_email as $user) {
                            $i = 0;
                            $user_info = User::where('email', $user)->get();
                            foreach($matches[1] as $key => $value)
                            {
                                $patterns[$i] = '['.$value.']';
                                if($value == 'id')
                                    $data[$j][$i] = $user_info[0]->user_id;
                                if($value == 'pw')
                                    $data[$j][$i] = $user_info[0]->pwd_store;
                                if($value == 'com')
                                    $data[$j][$i] = $user_info[0]->company_name;
                                if($value == 'unit')
                                    $data[$j][$i] = $user_info[0]->department_name;
                                if($value == 'posi')
                                    $data[$j][$i] = $user_info[0]->job_title;
                                if($value == 'name')
                                    $data[$j][$i] = $user_info[0]->name;
                                if($value == 'mail')
                                    $data[$j][$i] = $user_info[0]->email;
                                if($value == 'tel')
                                    $data[$j][$i] = $user_info[0]->phone;
                                if($value == 'post')
                                    $data[$j][$i] = $user_info[0]->zipcode;
                                if($value == 'add1')
                                    $data[$j][$i] = $user_info[0]->address1;
                                if($value == 'add2')
                                    $data[$j][$i] = $user_info[0]->address2;
                                if($value == 'add3')
                                    $data[$j][$i] = $user_info[0]->address3;
                                if($value == 'add4')
                                    $data[$j][$i] = $user_info[0]->address4;
                                if($value == 'ind')
                                    $data[$j][$i] = $user_info[0]->sectors;
                                $i++;
                            }
                            $j++;
                        }

                        $replace_body = array();
                        $k = 0;
                        foreach ($data as $item) {
                            $replace_body[$k] = str_replace($patterns, $item, $message->body);
                            $k++;
                        }
                    }
                    else {
                        $replace_body = $request->body;
                    }

                    $i = 0;
                    foreach ($message->to_email as $user) {
                        $user_info = User::where('email', $user)->get();
                        $from = getenv('MAIL_FROM_ADDRESS');
                        $to = new SendGrid\Mail\To($user_info[0]->email, $user_info[0]->name);
                        $subject = $message->title;
                        if($code_number)
                            $htmlContent = new SendGrid\Mail\HtmlContent(nl2br(e($replace_body[$i])));
                        else
                            $htmlContent = new SendGrid\Mail\HtmlContent(nl2br(e($replace_body)));
                        $email = new SendGrid\Mail\Mail(
                            $from,
                            $to,
                            $subject,
                            null,
                            $htmlContent
                        );
                        dispatch(new MailSend($email));
                        $i++;
                    }
                    toastr()->success('メールが正常に送信されました。','',config('toastr.options')); 
                    Message::where('id', $message->id)->update(array('delivered' => '送'));
                    Message::where('id', $message->id)->update(array('reserve_date' => $now));
                    Message::where('id', $message->id)->update(array('send_date' => $now));
                }
            });
        }
    }
}
