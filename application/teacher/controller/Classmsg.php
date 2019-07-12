<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/22
 * Time: 下午9:16
 */

namespace app\teacher\controller;


class Classmsg extends Common
{
    public function index()
    {
        return $this->fetch();
    }
}