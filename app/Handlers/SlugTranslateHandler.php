<?php

namespace App\Handlers;

use GuzzleHttp\Client;

class SlugTranslateHandler
{
    public function translate($text)
    {
    	$client = new Client();
    	$api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');
        $salt = time();

        if (empty($appid) || empty($appid)) {
            $this->pinying($text);

        }

        $sign = md5($appid . $text . $salt . $key);

        $params = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);

        $respone = $client->get($api, $params);

        $result = json_decode($respone, true);

        // 尝试获取获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            return str_slug($result['trans_result'][0]['dst']);
        } else {
            // 如果百度翻译没有结果，使用拼音作为后备计划。
            return $this->pinyin($text);
        }
    }

    public function pinying($text)
    {
        return str_slug($text);
    }

}