<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/3/10
 * Time: 下午2:00
 */

namespace app\common\lib;
use think\Loader;
use think\Config;
use think\Controller;

class Alipost extends Controller
{
    public static function index()
    {
        /**
         * Loader::import() 扩展类库（extend vendor）的Class文件，自动加载
         */
        Loader::import('alimsg.api_demo.SmsDemo',EXTEND_PATH);

        $accessKeyid=Config::get('accessKeyid');
        $accessKeySecret=Config::get('accessKeySecret');
        $msg=new \SmsDemo("$accessKeyid","$accessKeySecret");
        $res=$msg->sendSms(
            '云上知识',  //短信签名名称
            'SMS_159782804',  //模版code
            "18995230508", //短信授权手机号
            Array(
            )
        );
        if(!$res){
            return false;
        }
        return true;
    }

    public static function passt($number)
    {
        /**
         * Loader::import() 扩展类库（extend vendor）的Class文件，自动加载
         */
        Loader::import('alimsg.api_demo.SmsDemo',EXTEND_PATH);

        $accessKeyid=Config::get('accessKeyid');
        $accessKeySecret=Config::get('accessKeySecret');
        $msg=new \SmsDemo("$accessKeyid","$accessKeySecret");
        $res=$msg->sendSms(
            '云上知识',  //短信签名名称
            'SMS_160270124',  //模版code
            "$number", //短信授权手机号
            Array(
            )
        );
        if(!$res){
            return false;
        }
        return true;
    }

    public static function refuest($number)
    {
        /**
         * Loader::import() 扩展类库（extend vendor）的Class文件，自动加载
         */
        Loader::import('alimsg.api_demo.SmsDemo',EXTEND_PATH);

        $accessKeyid=Config::get('accessKeyid');
        $accessKeySecret=Config::get('accessKeySecret');
        $msg=new \SmsDemo("$accessKeyid","$accessKeySecret");
        $res=$msg->sendSms(
            '云上知识',  //短信签名名称
            'SMS_160275229',  //模版code
            "$number", //短信授权手机号
            Array(
            )
        );
        if(!$res){
            return false;
        }
        return true;
    }
}