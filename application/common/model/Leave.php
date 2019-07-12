<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/18
 * Time: 下午8:38
 */

namespace app\common\model;


class Leave extends Common
{
    protected $autoWriteTimestamp = true;

    public function SaveLeave($data)
    {
        return $this->allowField(true)->save($data);
    }

    public function getAllLeave($user_num)
    {
        $data = [
            'user_num' => $user_num
        ];

        $order = [
            'status' => 'asc'
        ];
        return $this->where($data)->order($order)->paginate(10);
    }

    public function getAllStuLeave()
    {
        $order = [
            'status' => 'asc'
        ];
        return $this->order($order)->paginate(10);
    }

    public function getAllWaitLeave($status = 1)
    {
        $data = [
            'status' =>  $status
        ];

        $order = [
            'create_time' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate('10');
    }

    public function countAllWaitLeave($status = 1)
    {
        $data = [
            'status' =>  $status
        ];
        return $this->where($data)->count();
    }

    public function countAllLeave()
    {
        return $this->count();
    }
}