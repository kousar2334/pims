<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    //sms user name kousar2334
    //password RCHGPABK
    public function smsSetting()
    {
    	return view('admin.modules.sms.smsSetting');
    }

    public function smsToAll()
    {
    	return view('admin.modules.sms.smsToAll');
    }
    public function sendSms()
    {
    	return view('admin.modules.sms.sendSms');
    }
    //sendSingleSms
    public function sendSingleSms(Request $request)
    {
        $number=$request->customer_id;
        $message=$request->message;
        $url = "http://66.45.237.70/api.php";
        $number=$number;
        $text=$message;
        $data= array(
            'username'=>"kousar2334",
            'password'=>"RCHGPABK",
            'number'=>"$number",
            'message'=>"$text"
        );

$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$smsresult = curl_exec($ch);
$p = explode("|",$smsresult);
$sendstatus = $p[0];
return $smsresult;
}
}
