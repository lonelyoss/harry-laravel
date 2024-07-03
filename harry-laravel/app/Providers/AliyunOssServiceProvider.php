<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Aliyun\IAliyunOss;
use App\Services\Aliyun\AliyunOssService;
class AliyunOssServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(IAliyunOss::class, function ($app) {
            $config = $app['config']['aliyun'];
            return new AliyunOssService($config);
        });
    }
}
