<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/11
 * Time: 上午11:30
 */

namespace app\common\model;


class Userlogin extends Common
{
    public function SaveLoginInfo($Idata)
    {
        if(!is_array($Idata)){
            exception('传递参数不合法');
        }
        $this->save($Idata);
        return $this->user_num;
    }

    public function lastLogin($userId)
    {
        $data = [
            'user_num' => $userId
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)->order($order)->paginate(10);
    }
}