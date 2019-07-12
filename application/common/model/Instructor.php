<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/12
 * Time: 上午11:44
 */

namespace app\common\model;


class Instructor extends Common
{
    public function getInstructor($usernum)
    {
        $data = [
            'usernum' => $usernum
        ];
        return $this->where($data)->select();
    }
}