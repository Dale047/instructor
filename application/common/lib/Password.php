<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/20
 * Time: 下午7:14
 */

namespace app\common\lib;
use think\Controller;

class Password extends Controller
{
    public static function setMd5Password($password){
        return md5(config('login.password_start').$password.config('login.password_end'));
    }
}