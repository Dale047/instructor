<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/12
 * Time: 上午11:47
 */

namespace app\common\model;


class Classinfo extends Common
{
    public function getClassInfo($classid)
    {
        $data = [
            'class_id' => $classid
            ];
        return $this->where($data)->select();
    }

    public function getThisInsClassInfo($ins_num)
    {
        $data = [
            'instructor' => $ins_num
        ];
        return $this->where($data)->select();
    }
}