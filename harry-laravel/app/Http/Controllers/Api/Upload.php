<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Aliyun\IAliyunOss;
use Illuminate\Http\Request;

class Upload extends Controller
{
    public function policy(Request $request)
    {
        $params = $request->post();
        $ossClient = app(IAliyunOss::class);
        return $ossClient->policy($params);
    }
}
