<?php

namespace App\Http\Controllers;

use App\Enums\ErrorCodeEnums;
use App\Helper\ArrayHelper;
use App\Requests\BaseRequest;
use App\Traits\LoggerTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Monolog\Logger;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, LoggerTrait;

    /**
     * @desc 通用返回json响应的方法
     * @param  int  $code
     * @param  array  $data
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJson(int $code, array $data, string $message = '成功')
    {
        $code = $code == 0 ? 50000 : $code;

        $response = array(
            'code' => $code,
            'data' => $data,
            'msg'  => empty($message) ? ErrorCodeEnums::getCodeDefinition($code) : $message,
        );

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @desc 通用BaseRequest校验方法
     * @param  BaseRequest  $request
     * @throws \Exception
     */
    public function validateRequest(BaseRequest $request)
    {
        $rs = $request->validateParams();
        if (!$rs['status']) {
            $errorCode = ErrorCodeEnums::ERROR_CODE_PARAMS_INVALID;
            $errorType = ErrorCodeEnums::getCodeDefinition($errorCode);
            throw new \Exception($errorType.':'.$rs['msg'], $errorCode);
        }
    }

    /**
     * @desc 通用参数校验方法
     * @param  array  $params
     * @param  array  $rules
     * @throws \Exception
     */
    public function validateParams(array $params, array $rules)
    {
        $field_names = [];
        $rule_data = [];
        foreach ($rules as $key => $rule) {
            $rule_data[$key] = $rule[0];
            $field_names[$key] = $rule[1];
        }

        $rs = ['status' => true];

        $validator = Validator::make($params, $rule_data, [], $field_names);
        if ($validator->fails()) {
            $message = '';
            if ($validator->errors() && !empty($validator->errors())) {
                $params = json_decode($validator->errors(), true);
                if (!empty($params)) {
                    foreach ($params as $value) {
                        $message .= implode(',', $value).';';
                    }
                }
            }
            $rs = ['status' => false, 'msg' => $message];
        }

        if (!$rs['status']) {
            $errorCode = ErrorCodeEnums::ERROR_CODE_PARAMS_INVALID;
            $errorType = ErrorCodeEnums::getCodeDefinition($errorCode);
            throw new \Exception($errorType.':'.$rs['msg'], $errorCode);
        }
    }

    /**
     * @desc 处理异常日志
     * @param  \Throwable  $throwable
     * @param  string  $title
     * @param  string  $method
     * @return bool
     */
    public function errorLog(\Throwable $throwable, string $title, string $method, string $logFileName)
    {
        //  参数错误,单独记录日志
        if (in_array($throwable->getCode(), ErrorCodeEnums::ERROR_CODE_PARAMS_ARR)) {
            Log::error($method.' 参数错误', ArrayHelper::getThrowableInfo($throwable, 'BusinessName Demo'));
            return false;
        }

        self::logger(ArrayHelper::getThrowableInfo($throwable, $title), $method, $logFileName, Logger::ERROR);
        return true;
    }
}
