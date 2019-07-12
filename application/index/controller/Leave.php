<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/14
 * Time: 下午2:31
 */

namespace app\index\controller;
use app\common\lib;

class Leave extends Common
{
    public function index()
    {
        if(request()->isPOST()){
            $data = input('post.');
            if(!is_array($data) || empty($data)){
                $this->error('非法操作');
            }
            /*******************请假日期*********************************/
            if($data['type']==1){
                $data['leave_end']=$data['leave_start'];
            }
            /*******************节次请假时间(拼接字符串)********************/
            $leave="";
            foreach ($data['leave_class'] as $value){
                $leave .= $value;
            }
            $data['leave_class'] = $leave;
            /*******************选择附件上传地址**************************/
            $res = lib\MoveFile::UpLeaveFile();
            if(!$res){
                $data['SavePath'] = "";
            }else {
                $data['SavePath'] = $res->getPathname();
            }
            /********************存储数据********************************/
            $res = Model('Leave')->SaveLeave($data);
            if(!$res){
                $this->error('参数错误');
            }
            return $this->success('添加成功');
        }else {
            return $this->fetch();
        }
    }

    public function longleave()
    {
        if(!request()->isPOST()){
            $this->error('请求方式错误');
        }
        $data = input('post.');
        /*******************请假节次置空*********************************/
        if($data['type']==2){
            $data['leave_class']="";
        }
        /*******************选择附件上传地址**************************/
        $res = lib\MoveFile::UpLeaveFile();
        if(!$res){
            $data['SavePath'] = "";
        }else {
            $data['SavePath'] = $res->getPathname();
        }
        $res = Model('Leave')->SaveLeave($data);
        if(!$res){
            $this->error('参数错误');
        }
        return $this->success('添加成功');
    }

    public function leaveinfo()
    {
        $id = lib\Message::getMsgId();
        //echo $id;
        $data = Model('Leave')->getMsg($id);
        $this->assign([
            'data'  =>  $data
        ]);
        return $this->fetch();
    }
}