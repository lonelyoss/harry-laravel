<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Aliyun\IAliyunOss;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Upload extends Controller
{
    /**
     * 获取客户端直传秘钥
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function policy(Request $request): JsonResponse
    {
        $params = $request->post();
        $ossClient = app(IAliyunOss::class);
        $key = 'upload' . date('/Y/m/d/') . $params['filename'];
        return $this->successResponse($ossClient->policy($key));
    }
}
