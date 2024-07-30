<?php

namespace App\Services\Aliyun;

interface IAliyunOss
{
    /**
     * 直传秘钥
     *
     * @param array $params
     * @return mixed
     */
    public function policy(array $params);
}
