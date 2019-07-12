<?php
namespace app\index\controller;
use app\common\lib;

class Index extends Common
{
    public function index()
    {
        /*用户信息首部提示*/
        $UserInfoMsg = config('Msg.userinfo');
        /*导员信息首部提示*/
        $Instructor  = config('Msg.instructor');
        $this->assign([
            'usermsg'  =>  $UserInfoMsg,
            'instructor'=>  $Instructor
        ]);
        return $this->fetch();
    }
}
