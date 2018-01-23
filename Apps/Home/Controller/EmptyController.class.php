<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 13:13
 */
namespace Home\Controller;

use Think\Controller;

class EmptyController extends Controller
{

    public function index()
    {
        $this->display("Common:404");
    }

    public function _empty()
    {
        $this->display("Common:404");
    }
}