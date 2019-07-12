<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/14
 * Time: 下午4:52
 */

namespace app\common\model;


class Alert extends Common
{
    protected $autoWriteTimestamp = true;

    public function getAllAlertList($class_id)
    {
        $order = [
            'create_time' => 'desc'
        ];

        $data = [
            'class_id' => $class_id
        ];

        return $this->where($data)->order($order)->paginate(10);
    }
}