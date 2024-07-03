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
        return $params;
    }
}
