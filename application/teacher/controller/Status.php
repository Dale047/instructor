<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/22
 * Time: 下午9:45
 */

namespace app\teacher\controller;


class Status extends Common
{
    public function leave()
    {
        return $this->fetch();
    }

    public function reward()
    {
        return $this->fetch();
    }
}