<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 17:14
 */
namespace Manage\Controller;

class FilesController extends InitController {

    /**
     *图片上传通用
     */
    public function uploads()
    {
        $data = $this->uploadImg(CONTROLLER_NAME,$this->ajaxResponse());
        $this->ajaxReturn($data, true);
    }
}