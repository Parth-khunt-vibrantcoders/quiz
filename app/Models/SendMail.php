<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Config;
use Illuminate\Support\Facades\DB;
use Mail;

class SendMail extends Model
{
    use HasFactory;

    public function sendMailltesting(){
        $mailData['data']='';
        $mailData['subject'] = Config::get('constants.SYSTEM_NAME');
        $mailData['attachment'] = array();
        $mailData['template'] ="emailtemplate.test";
        $mailData['mailto'] = 'test.vibrantcoders@gmail.com';
        $sendMail = new Sendmail();
        return $sendMail->sendSMTPMail($mailData);
    }

    public function sendSMTPMail($mailData)
    {
        $pathToFile = $mailData['attachment'];
        $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], function ($m) use ($mailData,$pathToFile) {
            $m->from('pkhunt@vibrantcoders.com', Config::get('constants.SYSTEM_NAME'));
            $m->to($mailData['mailto'], Config::get('constants.SYSTEM_NAME'))->subject($mailData['subject']);
            if($pathToFile != ""){
            }
        });

        if($mailsend){
            // return true;
        }else{
            // return false;
        }
    }

}
