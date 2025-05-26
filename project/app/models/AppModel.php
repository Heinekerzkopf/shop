<?php

namespace app\models;

use wfm\Model;

use RedBeanPHP\R;

class AppModel extends Model
{
    public static function create_slug($table, $field, $str, $id): string
    {
        $str = self::str2url($str);
        $res = R::findOne($table, "$field = ?", [$str]);
        if ($res) {
            $str = "{$str}-{$id}";
            $res = R::count($table, "$field = ?", [$str]);
            if ($res) {
                $str = self::create_slug($table, $field, $str, $id);
            }
        }
        return $str;
    }

    public static function str2url($str): string
    {
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }
}