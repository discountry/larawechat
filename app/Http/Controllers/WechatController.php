<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.');

        $wechat = app('wechat');
        $server = $wechat->server;
        $user = $wechat->user;

        $server->setMessageHandler(function($message) use ($user) {
            $fromUser = $user->get($message->FromUserName);

            return "{$fromUser->nickname} 您好！欢迎关注 larawechat!";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}
