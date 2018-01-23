<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/24
 * Time: 15:46
 */
namespace Manage\Controller;

use Common\Logic\MenuLogic;

class MenuController extends InitController {

    /**
     * 菜单首页
     */
    public function index() {
        $params = array(
            'name' =>getParams('name')
        );
        $MenuLogic = new MenuLogic();
        $menuList = $MenuLogic->getMenuList($params,$this->ajaxResponse());
        $menuSelect = $MenuLogic->getFistMenus();
        $this->assign('menuList',$menuList);
        $this->assign('menuSelect',$menuSelect);
        $this->display();
    }

    /**
     * 菜单添加
     */
    public function add() {
        $needParams = array('parentId','name','controller','action','status');
        $params = $this->checkParams($needParams);
        $MenuLogic = new MenuLogic();
        $MenuLogic->addMenu($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    /**
     * 菜单删除
     */
    public function drop(){
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $MenuLogic = new MenuLogic();
        $MenuLogic->dropMenu($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function edit() {
        $needParams = array('id','parentId','name','controller','action','status');
        $params = $this->checkParams($needParams);
        $MenuLogic = new MenuLogic();
        $MenuLogic->editMenu($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

}