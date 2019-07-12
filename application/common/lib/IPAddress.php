<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/3/15
 * Time: 下午5:15
 */

namespace app\common\lib;
use think\Loader;
use think\Controller;

class IPAddress extends Controller
{
    /**
     * @param $loginIP 用户IP地址
     * @return string 用户登录地点
     */
    public function getAddByIp($loginIP)
    {
        /*自动加载*/
        Loader::import('org.net.IpLocation',EXTEND_PATH,'.class.php');
        $ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $data = $ip->getlocation($loginIP);

        /*utf-8转码到gbk*/
        $AddByIP = iconv('gbk','utf-8',$data['country'].$data['area']);
        return $AddByIP;
    }
}