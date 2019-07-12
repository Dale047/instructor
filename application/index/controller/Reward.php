<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/19
 * Time: 下午4:13
 */

namespace app\index\controller;
use app\common\lib;

class Reward extends Common
{
    public function index()
    {
        if(request()->isPOST()){
            $data = input('post.');
            if(empty($data) || !is_array($data)){
                $this->error('非法访问');
            }
            //var_dump($data);
            /*******************选择附件上传地址**************************/
            if(empty($data['SavePath']) || !isset($data['SavePath'])){
                $data['SavePath'] = "";
            }else{
                $res = lib\MoveFile::UpRewardFile();
                if(!$res){
                    $data['SavePath'] = "";
                }else {
                    $data['SavePath'] = $res->getPathname();
                }
            }
            /*******************数据储存*********************************/
            $res = Model('Reward')->save($data);
            if(!$res){
                $this->error('数据不完整或参数错误');
            }
            return $this->success('申请成功',url('index/index/index'));
        }else {
            $MatchLevel = config('reward.level');
            $MatchType = config('reward.type');
            $this->assign([
                'MatchLevel' => $MatchLevel,
                'MatchType' => $MatchType
            ]);
            return $this->fetch();
        }
    }

    public function rewdinfo()
    {
        $id = lib\Message::getMsgId();
        $data = Model('Reward')->getMsg($id);
        $this->assign([
            'data'  =>  $data
        ]);
        return $this->fetch();
    }
}