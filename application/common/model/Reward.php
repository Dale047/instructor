<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/19
 * Time: 下午4:52
 */

namespace app\common\model;


class Reward extends Common
{
    protected $autoWriteTimestamp = true;

    public function getAllReward($user_num)
    {
        $data = [
            'user_num'  => $user_num
        ];
        return $this->where($data)->paginate(10);
    }

    public function getAllStuReward()
    {
        $order = [
            'status' => 'asc'
        ];
        return $this->order($order)->paginate(10);
    }

    public function getAllWaitReward($status = 1)
    {
        $data = [
            'status' =>  $status
        ];

        $order = [
            'create_time' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate('10');
    }

    public function countAllWaitReward($status = 1)
    {
        $data = [
            'status' =>  $status
        ];
        return $this->where($data)->count();
    }

    public function countAllReward()
    {
        return $this->count();
    }
}