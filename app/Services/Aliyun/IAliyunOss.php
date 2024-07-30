<?php

namespace App\Services\Aliyun;

interface IAliyunOss
{
    /**
     * 直传秘钥
     *
     * @param string $bucket
     * @param string $object
     * @param int $expire
     * @return mixed
     */
    public function policy(string $object, string $bucket = '' , int $expire = 180);
}
