<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/20
 * Time: 下午7:40
 */

namespace app\teacher\controller;
use app\common\lib;

class Index extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function content()
    {
        return $this->fetch();
    }

    public function userinfo()
    {
        if(request()->isPOST()){
            $data = input('post.');
//            var_dump($data);
        /***************************处理接收数据***********************/
            if(empty($data) || !isset($data) || !is_array($data)){
                echo "<script type='text/javascript'>alert('非法访问!');history.back();</script>";
                exit();
            }
            $res = Model('Instructor')->save($data,['id'=>$data['id']]);
            if(!$res){
                echo "<script type='text/javascript'>alert('没有做任何修改!');history.back();</script>";
            }
            echo "<script type='text/javascript'>alert('修改成功!');history.back();</script>";
        }else {
            return $this->fetch();
        }
    }
}