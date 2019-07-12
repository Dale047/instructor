<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/20
 * Time: 上午10:24
 */

namespace app\index\controller;
use app\common\lib;

class Author extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function stuinfo()
    {
        return $this->fetch();
    }

    /**
     * @param int $id 唯一主键
     * @param array $data 所有接收数据
     */
    public function CUserinfo()
    {
        if(!request()->isPOST()){
            $this->error('请求方式错误');
        }
        $data = input('post.');
        $id = lib\Message::getMsgId();
        try{
            $res = Model('Student')->save($data,['id'=>$id]);
            if(!$res){
                echo "<script type='text/javascript'>alert('没有做任何修改');history.back();</script>";
                exit();
            }
            return "<script type='text/javascript'>alert('修改成功');history.back();</script>";
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }

    public function classinfo()
    {
        return $this->fetch();
    }

    public function insinfo()
    {
        return $this->fetch();
    }

    public function about()
    {
        return $this->fetch();
    }

    public function logininfo()
    {
        return $this->fetch();
    }

    public function sign()
    {
        return $this->fetch();
    }

    public function leave()
    {
        return $this->fetch();
    }

    public function reward()
    {
        return $this->fetch();
    }
}