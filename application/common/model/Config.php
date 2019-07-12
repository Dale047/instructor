<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/11
 * Time: 上午11:16
 */

namespace app\common\model;


class Config extends Common
{
    /**
     * @param string $site 站点配置参数
     * @return array sitename 站点信息
     */
    public function getSiteName($site='sitename')
    {
        $data = [
            'name' => $site
        ];
        return $this->where($data)->select();
    }

    public function getSiteTel($site='sitetel')
    {
        $data = [
            'name' => $site
        ];
        return $this->where($data)->select();
    }

    /**
     * @param string $copy 版权配置参数
     * @return array copyname 版权信息
     */
    public function getCopyName($copy='copyname')
    {
        $data = [
            'name' => $copy
        ];
        return $this->where($data)->select();
    }

    /**
     * @param string $banner banner参数
     * @return array banner所有视图信息
     */
    public function getAllBanner($banner='banner')
    {
        $data = [
            'name' => $banner
        ];
        return $this->where($data)->select();
    }

    /**
     * @param string $tip配置参数
     * @return array 首页提示信息
     */
    public function getAllTip($tip='tip')
    {
        $data = [
            'name' => $tip
        ];
        return $this->where($data)->select();
    }

    /**
     * @param string $about 关于网站配置参数
     * @return array 关于网站配置所有信息
     */
    public function getAboutMsg($about='about')
    {
        $data = [
            'name' => $about
        ];

        return $this->where($data)->select();
    }

    public function getAllLeaveRes($leave='leave')
    {
        $data = [
            'name' => $leave
        ];
        return $this->where($data)->select();
    }
}