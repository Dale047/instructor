<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/20
 * Time: 下午7:28
 */

namespace app\teacher\controller;
use app\common\lib;

class Login extends Common
{
    public function _initialize()
    {
        /*禁止网页重定向*/
        /*网站站点信息*/
        $SiteName = Model('Config')->getSiteName();
        /*网站版权信息*/
        $CopyName = Model('Config')->getCopyName();
        /*网站版权信息*/
        $SiteTel = Model('Config')->getSiteTel();
        $this->assign([
            'SiteName'  =>  $SiteName,
            'CopyName'  =>  $CopyName,
            'SiteTel'   =>  $SiteTel
        ]);
    }

    public function index()
    {
        if(request()->isPOST()){
            /***************************接收数据*************************/
            $data = input('post.');
            /***************************处理非法访问**********************/
            if(empty($data) || !isset($data) || !is_array($data)){
                $this->error('非法访问');
            }
            /***************************处理验证码************************/
            if (!captcha_check($data['code'])) {
                echo "<script type='text/javascript'>alert('验证码错误！');history.back();</script>";
                exit();
            }
            /***************************处理接收数据***********************/
            if(empty($data['username']) || empty($data['password'])){
                echo "<script type='text/javascript'>alert('数据不能为空！');history.back();</script>";
                exit();
            }
            /***************************验证数据***************************/
            try{
                $ins_info = Model('Instructor')->get(['usernum'=>$data['username'],'password'=>lib\Password::setMd5Password($data['password'])]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            if(!$ins_info){
                $this->error('用户名或密码错误');
            }
            /***************************记录登录信息*************************/
            $Idata = [
                'user_num'  =>  $ins_info['usernum'],
                'status'    =>  '1',
                'username'  =>  $ins_info['username'],
                'class_id'  =>  'Teacher',
                'last_login_time'   =>  time(),
                'last_login_ip'     =>  request()->ip(),
            ];
            Model('Userlogin')->save($Idata);
            /***************************登记session记录信息******************/
            session(config('login.session_teacher'),$ins_info,config('login.session_teacher_scope'));
            $this->success('欢迎您'.$ins_info['username'].'辅导员',url('teacher/index/index'));
        }else {
            return $this->fetch();
        }
    }

    public function logout()
    {
        session(null,config('login.session_teacher_scope'));
        $this->success('退出成功',url('teacher/login/index'));
    }
}