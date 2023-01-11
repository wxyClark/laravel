<?php


namespace App\Helper;


class ArrayHelper
{
    /**
     * @desc  参数项转为数组格式
     * @param $param
     * @return array
     */
    static public function paramsItemToArray($param){
        return is_array($param) ? $param : [$param];
    }
}
