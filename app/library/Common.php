<?php

class Common
{

    /**
     * 获取随机字符串
     */
    public static function getRandStr($length)
    {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $res = '';
        for($i=1; $i<=$length; $i++) {
            $r = rand(0, 61);
            $res .= $str[$r];
        }
        return $res;
    }

}