<?php

namespace App\Services;

use App\Enums\ErrorCodeEnums;
use App\Helper\ArrayHelper;
use App\Traits\LoggerTrait;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class BaseService
{
    use LoggerTrait;

    /**
     * @desc 处理异常日志
     * @param  \Throwable  $throwable
     * @param  string  $title
     * @param  string  $method
     * @param  string  $logFileName
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
