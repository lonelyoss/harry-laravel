<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
class RemoveBgController
{
    public function index(Request $request)
    {
        $params = $request->post();
        return $params;
    }
}
