<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/13
 * Time: 下午8:20
 */

namespace app\common\model;


class Night extends Common
{
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    public function getAllNightSign($num_user)
    {
        $data = [
            'user_num'   => $num_user
        ];
        $order = [
            'create_time' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(10);
    }

    public function getAllStuNightSign()
    {
        $order = [
            'create_time' => 'desc'
        ];
        return $this->order($order)->paginate(10);
    }

    public function countAllSign()
    {
        return $this->count();
    }
}