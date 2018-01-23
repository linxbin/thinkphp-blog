<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/24
 * Time: 17:33
 */
namespace Common\Logic;

use Common\Model\AuthGroupAccessModel;
use Common\Model\AuthRuleModel;
use Common\Model\BaseModel;
use Common\Model\MenuModel;
use Common\Util\ErrCode;

class MenuLogic {

    /**
     * 添加菜单
     * @param $params
     * @param $response
     * @return bool
     */
    public function addMenu($params,$response) {

        $data = array(
            'pid' => $params['parentId'],
            'name' => $params['name'],
            'controller' => $params['controller'],
            'action' => $params['action'],
            'status' => $params['status']
        );
        $MenuModel = new MenuModel();
        $res = $MenuModel->add($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 获取菜单列表
     * @param $response
     * @return mixed
     */
    public function getMenuList($params = array(),$response) {
        $MenuModel = new MenuModel();
        foreach ($params as $key => $value) {
            if ($value != null) {
                $condition[$key] = array('like', '%' . $value . '%');
            }
        }
        $menu = $MenuModel->getMenus($condition);
        if($menu===false) {
            $response(ErrCode::SQL_ERROR);
        }
        $menu = rankList($menu);
        return formRankLists($menu);
    }

    /**
     * 删除菜单
     * @param $params
     * @param $response
     * @return bool
     */
    public function dropMenu($params,$response){

        $MenuModel = new MenuModel();
        $opt = array(
            'pid' => $params['id'],
            'id' => $params['id'],
            '_logic' => 'OR'
         );
        $condition = array($opt);
        $res = $MenuModel->where($condition)->setField('status',BaseModel::STATUS_DROP);
        if($res===false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 编辑菜单
     * @param $params
     * @param $response
     * @return bool
     */
    public function editMenu($params,$response) {

         $MenuModel = new MenuModel();
         $data = array(
             'id' => $params['id'],
             'name' => $params['name'],
             'pid' => $params['parentId'],
             'controller' => $params['controller'],
             'action' => $params['action'],
             'status' => $params['status']
         );
         $res = $MenuModel->save($data);
         if($res===false) {
             $response(ErrCode::SQL_ERROR);
         }
         return true;
    }

    /**获取一级菜单列表
     * @return mixed
     */
    public function getFistMenus() {
        $MenuModel = new MenuModel();
        $fistMenus = $MenuModel->getFistMenus();
        return $fistMenus;
    }

    /**
     * 创建系统后台菜单列表
     * @return array
     */
    public function createMenus() {

        //获取系统菜单
        $MenuModel = new MenuModel();
        $opt = array(
            'status' => BaseModel::STATUS_DEFAULT
        );
        $menus = $MenuModel->getMenus($opt);
        foreach($menus as &$val) {
            if($val['controller'] !== '#'){
                $val['url'] = '/'.strtolower($val['controller']) .'/'. strtolower($val['action']);
            }else{
                $val['url'] = strtolower($val['controller']);
            }
        }
        //获取用户具备的权限
        $AuthGroupAccess = new AuthGroupAccessModel();
        $res = $AuthGroupAccess->getRulesIdByUid(session('adminId'));
        $AuthRuleModel = new AuthRuleModel();
        $res['rules'] = $AuthRuleModel->getRulesByIds($res['rules']);
        //匹配权限与菜单
        foreach($menus as $i => $menu) {
            if(in_array($menu['url'],$res['rules']) === false) {
                unset($menus[$i]);
            } else if($menu['controller'] !== '#'){
                $menus[$i]['url'] = U($menu['controller'].'/'.$menu['action']);
            }

        }
        //菜单关联排序
        $menus = rankList($menus);
        //过滤没有子菜单的菜单
        foreach ( $menus as $key => $menu ) {
            if( !isset($menu['children']) ) {
                unset($menus[$key]);
            }
        }
        //菜单重新排序
        sort($menus);
        return $menus;
    }
}