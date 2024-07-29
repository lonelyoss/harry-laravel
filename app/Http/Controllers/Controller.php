<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 成功返回数据
     *
     * @param array $data
     * @return JsonResponse
     */
    public function successResponse(array $data): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'code' => '0',
            'data' => $data
        ]);
    }


    /**
     * 失败返回数据
     *
     * @param int $code
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function failResponse(int $code, string $message, int $status): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'msg' => $message
        ], $status);
    }
}
