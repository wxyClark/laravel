<?php

namespace App\Traits;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait LoggerTrait
{
    /**
     * @desc 日志  指定日志目录  eg: /logs/error/*.log
     * @param  array  $data
     * @param  string  $title
     * @param  string  $errorLogName
     * @param  int  $level
     * @return false
     */
    public static function logger(array $data, string $title = '', string $logFileName = 'laravel', int $level = Logger::INFO)
    {
        if (empty($data)) {
            return false;
        }

        $levelName = Logger::getLevelName($level);
        $path = 'logs/'.$levelName.'/'.$logFileName.'_'.date('Y-m-d').'.log';
        $log  = new Logger($logFileName);
        $log->pushHandler(new StreamHandler(storage_path($path)));
        $log->addRecord($level, $title, $data);
    }
}
