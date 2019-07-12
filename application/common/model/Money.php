<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/19
 * Time: 下午7:56
 */

namespace app\common\model;


class Money extends Common
{
    protected $autoWriteTimestamp = true;

    public function SaveData($data)
    {
        $this->save($data);
        return $this->id;
    }

    public function getAllASCMoneyInfo()
    {
        $order = [
            'id' => 'asc'
        ];
        return $this->order($order)->paginate(10);
    }

    public function getAllDescMoneyInfo()
    {
        $order = [
            'id' => 'desc'
        ];
        return $this->order($order)->paginate(10);
    }

    public function getAllMoneyList($class_id)
    {
        $data = [
            'class_id' => $class_id
        ];
        $order = [
            'create_time' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(10);
    }
}