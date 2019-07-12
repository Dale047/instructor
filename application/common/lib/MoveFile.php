<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/3/6
 * Time: 上午8:25
 */
namespace app\common\lib;
use think\File;
use think\Request;
use think\Controller;
use think\Image;

class MoveFile extends Controller
{
    /**
     * @return array() | $info
     * FileTypeJudge() 判断文件属性
     * 返回布尔文件移动信息
     */
    public static function UpFaceFile()
    {
        $file = Request::instance()->file('file');
        if(empty($file) || !isset($file)){
            echo "<script>alert('请启动相机');history.back()</script>";
            exit();
        }
        /*$file->getInfo()['name']; 获取文件上传名*/
        $title = $file->getInfo()['name'];
        $file_num = strrpos($title, '.');
        $file_type = substr($title, $file_num + 1);
        FileTypeJudge($file_type);
        /*移动目标文件*/
        $info = $file->move('./face/');
        return $info;
    }

    /**
     * @param $info
     * @return array
     */
    public static function getFileMsg($info)
    {
        $data = [
            'path' => './face/'.$info->getSaveName(),
            'paths' => $info->getSaveName()
        ];
        return $data;
    }

    /**
     * @return bool 文件移动结果
     */
    public static function UpAlertFile()
    {
        $file = Request::instance()->file('file');
        if(empty($file) || !isset($file)){
            return false;
        }
        /*$file->getInfo()['name']; 获取文件上传名*/
        $title = $file->getInfo()['name'];
        $file_num = strrpos($title, '.');
        $file_type = substr($title, $file_num + 1);
        FileTypeJudge($file_type);
        /*移动目标文件*/
        $info = $file->move('./alert/');
        return $info;
    }

    /**
     * @return bool 文件移动结果
     */
    public static function UpLeaveFile()
    {
        $file = Request::instance()->file('file');
        if(empty($file) || !isset($file)){
            return false;
        }
        /*$file->getInfo()['name']; 获取文件上传名*/
        $title = $file->getInfo()['name'];
        $file_num = strrpos($title, '.');
        $file_type = substr($title, $file_num + 1);
        FileTypeJudge($file_type);
        /*移动目标文件*/
        $info = $file->move('./leave/');
        return $info;
    }

    /**
     * @return bool 文件移动结果
     */
    public static function UpMoneyFile()
    {
        $file = Request::instance()->file('file');
        if(empty($file) || !isset($file)){
            return false;
        }
        /*$file->getInfo()['name']; 获取文件上传名*/
        $title = $file->getInfo()['name'];
        $file_num = strrpos($title, '.');
        $file_type = substr($title, $file_num + 1);
        FileTypeJudge($file_type);
        /*移动目标文件*/
        $info = $file->move('./money/');
        return $info;
    }

    /**
     * @return bool 文件移动结果
     */
    public static function UpRewardFile()
    {
        $file = Request::instance()->file('file');
        if(empty($file) || !isset($file)){
            return false;
        }
        /*$file->getInfo()['name']; 获取文件上传名*/
        $title = $file->getInfo()['name'];
        $file_num = strrpos($title, '.');
        $file_type = substr($title, $file_num + 1);
        FileTypeJudge($file_type);
        /*移动目标文件*/
        $info = $file->move('./reward/');
        return $info;
    }
}