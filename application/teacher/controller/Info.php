<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/22
 * Time: 下午8:34
 */

namespace app\teacher\controller;
use app\common\lib;
use think\Request;

class Info extends Common
{
    public function student()
    {
        return $this->fetch();
    }

    public function leaveinfo()
    {
        $id = lib\Message::getMsgId();
        $data = Model('Leave')->get(['id' => $id]);
        $this->assign([
            'data' => $data
        ]);
        return $this->fetch();
    }

    public function rewardinfo()
    {
        $id = lib\Message::getMsgId();
        $data = Model('Reward')->get(['id' => $id]);
        $this->assign([
            'data' => $data
        ]);
        return $this->fetch();
    }

    public function leavestatus()
    {
        $id = lib\Message::getMsgId();
        $status = Request::instance()->param('status');
        //echo $status;
        $res = Model('Leave')->save(['status'=>$status],['id'=>$id]);
        if(!$res){
            echo "<script type='text/javascript'>alert('没有做任何修改！');history.back();</script>";
            exit();
        }
        echo "<script type='text/javascript'>alert('已做处理！');history.back();</script>";
    }

    public function rewardstatus()
    {
        $id = lib\Message::getMsgId();
        $status = Request::instance()->param('status');
        //echo $status;
        $res = Model('Reward')->save(['status'=>$status],['id'=>$id]);
        if(!$res){
            echo "<script type='text/javascript'>alert('没有做任何修改！');history.back();</script>";
            exit();
        }
        echo "<script type='text/javascript'>alert('已做处理！');history.back();</script>";
    }

    public function studentinfo()
    {
        $id = lib\Message::getMsgId();
        $data = Model('Student')->get(['id' => $id]);
        $this->assign([
            'data' => $data
        ]);
        return $this->fetch();
    }

    public function stuide()
    {
        $id = lib\Message::getMsgId();
        $ide = Request::instance()->param('ide');
        $res = Model('Student')->save(['ide'=>$ide],['id'=>$id]);
        if(!$res){
            echo "<script type='text/javascript'>alert('没有做任何修改！');history.back();</script>";
            exit();
        }
        echo "<script type='text/javascript'>alert('已做处理！');history.back();</script>";
    }
}