<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/14
 * Time: 下午3:02
 */

namespace app\index\controller;
use app\common\lib;

class Alert extends Common
{
    public function index()
    {
        if(request()->isPOST()){
            $data = input('post.');
            //var_dump($data);
            $res = lib\MoveFile::UpAlertFile();
            if(!$res){
                $data['SavePath'] = "";
            }else {
                $data['SavePath'] = $res->getPathname();
            }
//            var_dump($data);
            $Ires = Model('Alert')->save($data);
            if(!$Ires){
                $this->error('参数错误');
            }
            $this->success('添加成功',url('index/index/index'));
        }else {
            return $this->fetch();
        }
    }
}