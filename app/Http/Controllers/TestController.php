<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{
    public function test(User $user)
    {
        $this->sms();
    }

    public function sms()
    {
        $sms = app('easysms');
        try {
            $sms->send(13117735073, [
                'template' => 'SMS_151766554',
                'data' => [
                    'code' => 6379
                ],
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('aliyun')->getMessage();
            dd($message);
        }
    }
}
