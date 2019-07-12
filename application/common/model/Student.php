<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/11
 * Time: 下午3:00
 */

namespace app\common\model;


class Student extends Common
{
    public function getAllThisInsStudent()
    {
        $data = [
            'status'    =>  '1'
        ];
        $order = [
            'class_id'  =>  'desc'
        ];
        return $this->order($order)->where($data)->select();
    }
}