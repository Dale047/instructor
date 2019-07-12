<?php
/**
 * Created by PhpStorm.
 * User: dale047
 * Date: 2019/4/11
 * Time: 上午11:18
 */

namespace app\common\model;
use think\Model;

class Common extends Model
{
    public function getMsg($id)
    {
        $data = [
            'id' => $id
        ];
        return $this->where($data)->select();
    }
}