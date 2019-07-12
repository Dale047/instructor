<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/3/19
 * Time: 下午3:14
 */

namespace app\common\lib;
use think\Controller;
use think\Request;

class Message extends Controller
{
    /**
     * static 静态变量方法封装任意消息id
     * @param id 参数id
     * @return array
     */
    public static function getMsgId()
    {
        $MsgId = Request::instance()->param('id');
        return $MsgId;
    }
}