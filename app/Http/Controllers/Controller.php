<?php

namespace App\Http\Controllers;

use App\Enums\ErrorCodeEnums;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @desc 通用返回json响应的方法
     * @param  int  $code
     * @param  array  $data
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJson(int $code, array $data, string $message = '')
    {
        $code = $code == 0 ? 50000 : $code;

        $response = array(
            'code'    => $code,
            'data'    => $data,
            'message' => empty($message) ? ErrorCodeEnums::getCodeDefinition($code) : $message,
        );

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
