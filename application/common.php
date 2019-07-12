<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @param instance()->isMobile()
 * return view_path
 */
use app\common\lib;

if(\think\Request::instance()->isMobile()){
    define('VIEW_PATH',__DIR__.'/../application/login/view/mobile/');
}else{
    define('VIEW_PATH',__DIR__.'/../application/login/view/pc/');
}

/**
 * @param $type 返回正确的文件格式
 */
function FileTypeJudge($type)
{
    /**
     * FileType 指定格式PNG、JPG、JPEG、BMP
     */
    $FileType = array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF');
    if(!in_array($type,$FileType))
    {
        echo "<script type='text/javascript'>alert('返回选择正确格式');history.back();</script>";
        exit();
    }
}

/**
 * @param $ip 获取IP地址
 * @return string IP详细信息
 */
function getAddress($ip)
{
    /*通过IP获取地址*/
    $getAdd = new lib\IPAddress();
    return $getAdd->getAddByIp($ip);
}

function getThisTime($time)
{
    return date('Y年m月d日 H:m:s',$time);
}

function NorStatus($status){
    if($status==0){
        $status = "<span class='label label-danger'>异常</span>";
    }elseif($status==1){
        $status = "<span class='label label-success'>正常</span>";
    }else{
        $status = "<span class='label label-danger'>参数错误</span>";
    }
    return $status;
}

function ClassStatus($status){
    if($status==0){
        $status = "<span class='label label-danger'>毕业/停办</span>";
    }elseif($status==1){
        $status = "<span class='label label-success'>在读</span>";
    }else{
        $status = "<span class='label label-danger'>参数错误</span>";
    }
    return $status;
}

function LeaveStatus($status){
    if($status==1){
        $status = "<span class='label label-warning'>待审核</span>";
    }elseif($status==2){
        $status = "<span class='label label-success'>通过</span>";
    }elseif($status==3){
        $status = "<span class='label label-danger'>未通过</span>";
    }else{
        $status = "<span class='label label-danger'>参数错误</span>";
    }
    return $status;
}

function LeaveType($res){
    if($res==1){
        $status = "节次请假";
    }elseif($res==2){
        $status = "长假期";
    }else{
        $status = "<span class='label label-danger'>参数错误</span>";
    }
    return $status;
}

function NorMsg($Msg){
    return "<mark>".$Msg."</mark>";
}

function getIde($ide){
    if($ide==1){
        $status = "<span class='label label-default'>普通用户</span>";
    }elseif($ide==2){
        $status = "<span class='label label-info'>班委</span>";
    }else{
        $status = "<span class='label label-danger'>参数错误</span>";
    }
    return $status;
}

function InsStatus($status){
    if($status==1){
        $res = "<span class='label label-success'>正常在校</span>";
    }elseif($status==2){
        $res = "<span class='label label-danger'>不在校/外出</span>";
    }else{
        $res = "<span class='label label-danger'>参数错误</span>";
    }
    return $res;
}

function NumThisUser($user_num){
    $res = new app\index\controller\Common();
    $user = $res->getThisLoginUser($user_num);
    return $user['username'];
}

function NumThisStu($user_num){
    $user = Model('Student')->get(['user_num'=>$user_num]);
    return $user['username'];
}

function MoneyType($num){
    if($num==1){
        $status = "支出";
    }elseif($num==2){
        $status = "收取";
    }else{
        $status = "参数错误";
    }
    return $status;
}

function getMajor($class_id){
    //$res = new app\index\controller\Common();
    $major = Model('Major')->get(['major_id' => $class_id]);
    return $major['name'];
}

function getCollegeId($major_id){
    //$res = new app\index\controller\Common();
    $major = Model('Major')->get(['major_id' => $major_id]);
    return $major['college_id'];
}

function getCollege($college_id){
    $College = Model('College')->get(['college_id' => $college_id]);
    return $College['name'];
}

function getMajorId($class_id){
    //$res = new app\index\controller\Common();
    $major = Model('Classinfo')->get(['class_id' => $class_id]);
    return $major['major_id'];
}

function getClassNum($class_id){
    $class = Model('Classinfo')->get(['class_id' => $class_id]);
    return $class['level'].'级'.$class['class'].'班';
}

function getIns($ins_num){
    $res = Model('Instructor')->getInstructor($ins_num);
    return $res['0']['username'];
}

function SignStatus($num){
    if($num==1){
        $status = "OK";
    }elseif($num==2){
        $status = "ERROR";
    }else{
        $status = "参数错误";
    }
    return $status;
}
