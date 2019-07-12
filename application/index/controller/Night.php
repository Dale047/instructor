<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/13
 * Time: 下午7:08
 */

namespace app\index\controller;


class Night extends Common
{
    public function index()
    {
        $time = $this->getConfigSignTime();
        $isSign = $this->checkTime($time['start']['value'],$time['end']['value']);
        if(!$isSign){
            echo "<script type='text/javascript'>alert('当前不在签到时间');history.back();</script>";
            exit();
        }
        return $this->fetch();
    }

    /**
     * @param string $start 规定开始签到时间
     * @param string $end  规定结束签到时间
     * @return bool 是否在规定时间内
     */
    public function checkTime($start,$end)
    {
        $thisTime = date('H:i');
        $curTime = strtotime($thisTime); //当前时分时间戳
        $startTime = strtotime($start); //辅导员规定开始时间
        $endTime = strtotime($end); //辅导员规定结束时间
        if(!($startTime<$curTime && $curTime<$endTime)){
            return false;
        }
        return true;
    }

    public function sign()
    {
        $user_num = $this->isLogin();
        $isSign = $this->isSign($user_num);
        if($isSign){
            echo "<script type='text/javascript'>alert('你已签到，请勿重复签到！');history.back();</script>";
            exit();
        }
        $Idata = [
            'user_num' => $user_num,
            'ip'       => request()->ip(),
            'status'   => '1',
            'sign'     => '1'
        ];
        try{
            $res = Model('Night')->save($Idata);
            if($res){
                 echo "<script type='text/javascript'>alert('签到成功！');history.back();</script>";
                }
            }catch(\Exception $e){
                $this->error($e->getMessage());
        }
    }

    /**
     * @param $user_num 当前登录用户学号
     * @return bool 是否重复签到 true 重复签到 false 未重复签到
     */
    public function isSign($user_num)
    {
        $last_sign = Model('Night')->getAllNightSign($user_num);
        $last_sign_time = $last_sign['0']['create_time'];
        //halt($last_sign_time);
        $last_sign_time = strtotime($last_sign_time);
        $thisTime = time();
        if(($thisTime-$last_sign_time)>(60*60*2)){
            return false;
        }
        return true;
    }
}