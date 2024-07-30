<?php

namespace App\Services\Aliyun;

class AliyunOssService implements IAliyunOss
{

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function policy(array $params)
    {
        $oss = config('aliyun', []);
        $id = $oss['appKeyId'] ?? '';
        $key = $oss['appSecret'] ?? '';
        $host = 'https://' . $oss['bucket'] . '.' . $oss['endpoint'];

        $callbackUrl = 'https://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . 'notify/aliyun/policy/';
        $callbackParam = [
            'callbackUrl' => $callbackUrl,
            'callbackBody' => '',
            'callbackBodyType' => 'application/x-www-form-urlencoded'
        ];
        $callbackString = json_encode($callbackParam);
        $base64CallbackBody = base64_encode($callbackString);
        $now = time();
        $expire = 30;
        $end = $now + $expire;
        $expiration = $this->gmtISO8601($end);
        $dir = '/uploads/' . date('Ym', time()) . '/';
        //最大文件大小.用户可以自己设置
        $condition = array(0 => 'content-length-range', 1 => 0, 2 => 1048576000);
        $conditions[] = $condition;

        //表示用户上传的数据,必须是以$dir开始, 不然上传会失败,这一步不是必须项,只是为了安全起见,防止用户通过policy上传到别人的目录
        $start = array(0 => 'starts-with', 1 => '$key', 2 => $dir);
        $conditions[] = $start;

        $arr = array('expiration' => $expiration, 'conditions' => $conditions);
        //echo json_encode($arr);
        //return;
        $policy = json_encode($arr);
        $base64_policy = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

        $response = array();
        $response['accessid'] = $id;
        $response['host'] = $host;
        $response['policy'] = $base64_policy;
        $response['signature'] = $signature;
        $response['expire'] = $end;
        $response['callback'] = $base64CallbackBody;
        $response['dir'] = $dir;
        return $response;
    }

    private function gmtISO8601($time): string
    {
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . "Z";
    }
}
