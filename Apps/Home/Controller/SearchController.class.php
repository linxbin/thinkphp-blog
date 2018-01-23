<?php
/**
 * Created by PhpStorm.
 * User: Yumkai
 * Date: 2017/10/27
 * Time: 下午9:06
 */

namespace Home\Controller;

use Common\Logic\ArticleLogic;

class SearchController extends InitController
{


    public function index()
    {
       $keyword =  getParams('keyword');
       $ArticleLogic = new ArticleLogic();
       $params = array(
           'keyword' => $keyword
       );
       $data  = $ArticleLogic -> getArticList($params, $page='' ,$this->errorFunc());
       $this -> assign($data);
       $this -> display();
    }

}