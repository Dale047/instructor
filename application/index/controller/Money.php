<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/14
 * Time: 下午10:01
 */

namespace app\index\controller;
use app\common\lib;

class Money extends Common
{
    public function index()
    {
        if(request()->isPOST()){
            $data = input('post.');
//            var_dump($data);
            /*****************非法访问******************************/
            if(empty($data) || !is_array($data)){
                $this->error('非法访问');
            }
            /*****************强制性添加附件******************************/
            $res = lib\MoveFile::UpMoneyFile();
            if(!$res){
                $this->error('返回添加附件');
            }else {
                $data['SavePath'] = $res->getPathname();
            }
            /*****************先存取数据，在做更新******************************/

            /*****************更新金额******************************/
            $PId = Model('Money')->SaveData($data);

            $ThisMoneyRes = $this->getThisMoneyRes($data['type']);

            $res = Model('Money')->save(['money_now' => $ThisMoneyRes],['id' => $PId]);
            if(!$res){
                $this->error('未知错误');
            }
            return $this->success('更新成功');
        }else {
            $ResIn = config('money.ResIn');
            $ResOut= config('money.ResOut');
            $this->assign([
                'ResIn' => $ResIn,
                'ResOut'=> $ResOut
            ]);
            return $this->fetch();
        }
    }

    public function getThisMoney()
    {
        $AllMoney = Model('Money')->getAllDescMoneyInfo();
        /*处理上一次剩余金额*/
        if(count($AllMoney)<=1){
            $data['LastMoneyRes'] = 0;
        }else{
            $data['LastMoneyRes'] = $AllMoney['1']['money_now'];
        }
        /*处理本次使用费用*/
        if(count($AllMoney)==0){
            $data['ThisMoney'] = 0;
        }else{
            $data['ThisMoney'] = $AllMoney['0']['money'];
        }
        return $data;
    }

    public function getThisMoneyRes($type)
    {
        $data = $this->getThisMoney();
        if($type==1){
            $ThisMoneyRes = $data['LastMoneyRes'] - $data['ThisMoney'];
        }else {
            $ThisMoneyRes = $data['LastMoneyRes'] + $data['ThisMoney'];
        }
        return $ThisMoneyRes;
    }

    public function moneyinfo()
    {
        $id = lib\Message::getMsgId();
        //echo $id;
        $data = Model('Money')->getMsg($id);
        $this->assign([
            'data'  =>  $data
        ]);
        return $this->fetch();
    }
}