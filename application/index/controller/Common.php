<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/11
 * Time: 上午11:22
 */

namespace app\index\controller;
use think\Controller;

class Common extends Controller
{
    private $student;
    private $config;
    private $instructor;
    private $classinfo;
    private $login;
    private $night;
    private $alert;
    private $leave;
    private $reward;
    private $money;
    private $major;

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->student    = Model('Student');
        $this->config     = Model('Config');
        $this->instructor = Model('Instructor');
        $this->classinfo  = Model('Classinfo');
        $this->login      = Model('Userlogin');
        $this->night      = Model('Night');
        $this->alert      = Model('Alert');
        $this->leave      = Model('Leave');
        $this->reward     = Model('Reward');
        $this->money      = Model('Money');
        $this->major      = Model('Major');
        /*检测是否登录*/
        $isLogin = $this->isLogin();
        if(!$isLogin){
            $this->redirect('login/index/index');
        }
        /*网站站点信息*/
        $SiteName = $this->config->getSiteName();
        /*网站版权信息*/
        $CopyName = $this->config->getCopyName();
        /*网站版权信息*/
        $SiteTel = $this->config->getSiteTel();
        /*获取banner信息*/
        $AllBanner = $this->getBanner();
        /*获取首页tip提示信息*/
        $AllTip = $this->getTip();
        /*当前登录学生所在班级辅导员所有信息*/
        $Instructor = $this->getThisInstructor();
        /*获取当前登录用户所在班级所有信息*/
        $ClassInfo = $this->getThisClassInfo();
        /*获取当前登录用户所有信息*/
        $UserInfo = $this->getThisSessionUser();
        /*获取当前用户的所有登录信息*/
        $UserLoginInfo = $this->getThisUserLoginInfo();
        /*获取站点about信息*/
        $About =$this->getAbout();
        /*获取签到时间*/
        $SignTime = $this->getConfigSignTime();
        /*获取当前用户的所有晚寝信息*/
        $NightSignInfo = $this->getNightSignInfo();
        /*获取所有公告信息*/
        $AlertList = $this->getAlertList($ClassInfo['0']['class_id']);
        /*获取所有请假的理由*/
        $LeaveRes = $this->getLeaveRes();
        /*获取当前登录用户请假记录*/
        $Leave = $this->getLeave();
        /*获取获奖信息*/
        $Reward = $this->getReward();
        /*所有班费详情*/
        $Money = $this->getMoneyList();

        $this->assign([
            'SiteName'       => $SiteName,
            'CopyName'       => $CopyName,
            'AllBanner'      => $AllBanner,
            'AllTip'         => $AllTip,
            'Instructor'     => $Instructor,
            'ClassInfo'      => $ClassInfo,
            'SiteTel'        => $SiteTel,
            'UserInfo'       => $UserInfo,
            'UserLoginInfo'  => $UserLoginInfo,
            'About'          => $About,
            'SignTime'       => $SignTime,
            'NightSignInfo'  => $NightSignInfo,
            'AlertList'      => $AlertList,
            'LeaveRes'       => $LeaveRes,
            'Leave'          => $Leave,
            'Reward'         => $Reward,
            'Money'          => $Money
        ]);
    }

    /**
     * @return bool 登录状态
     */
    public function isLogin()
    {
        $user_num = session(config('login.session_user'),'',config('login.session_user_scope'));
        if(!$user_num){
            return false;
        }
        return $user_num;
    }

    /**
     * @param int $user_num 当前登录用户的学号
     * @return array 当前登录用户的所有信息
     * @return bool false 非法操作
     */
    public function getThisSessionUser()
    {
        $user_num = $this->isLogin();
        if(!$user_num){
            echo "<script type='text/javascript'>alert('非法操作');history.back();</script>";
            exit();
        }
        $UserInfo = $this->student->get(['user_num'=>$user_num]);
        return $UserInfo;
    }

    /**
     * getThisLoginUser() 实时获取当前登录用户信息
     * getThisSessionUser() 从session获取当前登录用户信息
     * @param int $user_num 当前登录用户的学号
     * @return array 当前登录用户的所有信息
     */
    public function getThisLoginUser($user_num)
    {
        $UserInfo = $this->student->get(['user_num'=>$user_num]);
        return $UserInfo;
    }

    /**
     * @return array 首页轮播图所有链接
     */
    public function getBanner()
    {
        return $this->config->getAllBanner();
    }

    /**
     * @return array 首页滚动条所有信息
     */
    public function getTip()
    {
        return $this->config->getAllTip();
    }

    /**
     * @return array 获取当前登录用户所在班级所有信息
     */
    public function getThisClassInfo()
    {
        $userInfo = $this->getThisSessionUser();
        $ClassInfo = $this->classinfo->getClassInfo($userInfo['class_id']);
        return $ClassInfo;
    }

    /**
     * @return array 获取当前登录用户所在班级辅导员所有信息
     */
    public function getThisInstructor()
    {
        $ClassInfo = $this->getThisClassInfo();
        $Instructor = $this->instructor->getInstructor($ClassInfo['0']['instructor']);
        return $Instructor;
    }

    public function getThisUserLoginInfo()
    {
        $user_num = $this->isLogin();
        if(!$user_num){
            echo "<script type='text/javascript'>alert('非法操作');history.back();</script>";
            exit();
        }
        $UserLoginInfo = $this->login->lastLogin($user_num);
        return $UserLoginInfo;
    }

    public function getAbout()
    {
        $About = $this->config->getAboutMsg();
        return $About;
    }

    /**
     * @return array 获取配置里所有签到时间
     */
    public function getConfigSignTime()
    {
        /*晚归签到配置*/
        $nightstart = $this->config->get(['name'=>'nightstart']);
        $nightend = $this->config->get(['name'=>'nightend']);
        $data = [
            'start' => $nightstart,
            'end'   => $nightend
        ];
        return $data;
    }

    public function getNightSignInfo()
    {
        $user_num = $this->isLogin();
        $AllNightSign = $this->night->getAllNightSign($user_num);
        return $AllNightSign;
    }

    /**
     * @return array 获取所有公告信息 page 10
     */
    public function getAlertList($class_id)
    {
        $data = $this->alert->getAllAlertList($class_id);
        return $data;
    }

    public function getLeaveRes()
    {
        $data = $this->config->getAllLeaveRes();
        return $data;
    }

    public function getLeave()
    {
        $user_num = $this->isLogin();
        $data = $this->leave->getAllLeave($user_num);
        return $data;
    }

    public function getReward()
    {
        $user_num = $this->isLogin();
        $data = $this->reward->getAllReward($user_num);
        return $data;
    }

    public function getMoneyList()
    {
        $ClassInfo = $this->getThisSessionUser();
        $data = $this->money->getAllMoneyList($ClassInfo['class_id']);
        return $data;
    }

    public function logout()
    {
        $user_num = $this->isLogin();
        if(!$user_num){
            echo "<script type='text/javascript'>alert('非法操作');history.back();</script>";
            exit();
        }
        session(null,config('login.session_user_scope'));
        $this->success('退出成功',url('login/index/index'));
    }

    public function getThisMajorInfo($major_id)
    {
        $data = $this->major->get(['major_id' => $major_id]);
        return $data;
    }
}