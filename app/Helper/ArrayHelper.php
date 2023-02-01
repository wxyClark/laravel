<?php


namespace App\Helper;


class ArrayHelper
{
    /**
     * @desc  参数项转为数组格式
     * @param $param
     * @return array
     */
    public static function paramsItemToArray($param)
    {
        return is_array($param) ? $param : [$param];
    }

    /**
     * @desc 后去异常的基础信息
     * @param  \Throwable  $throwable
     * @param  string  $title
     * @return array
     */
    public static function getThrowableInfo(\Throwable $throwable, $title = '')
    {
        return [
            'title'   => $title,
            'code'    => $throwable->getCode(),
            'file'    => $throwable->getFile(),
            'line'    => $throwable->getLine(),
            'msg'     => $throwable->getMessage(),
            'request' => $_REQUEST,
            //  TODO 获取上一层的调用入口
        ];
    }
}
