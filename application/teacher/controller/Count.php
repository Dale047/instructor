<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/22
 * Time: 下午1:22
 */

namespace app\teacher\controller;

class Count extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function reward()
    {
        return $this->fetch();
    }

    public function sign()
    {
        return $this->fetch();
    }
}