<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/14 0014
 * Time: 下午 10:44
 */
namespace Home\Controller;


use Common\Logic\ArticleLogic;
use Common\Logic\ChannelLogic;

class ArticleController extends InitController
{

    public function index()
    {
        $id = getParams('id');
        $ArticleLogic = new ArticleLogic();
        $article = $ArticleLogic->getArticleById($id,$this->ajaxResponse());
        if(!$article) {
            $this->display("Common:404");
            return false;
        }
        ArticleLogic::addAtriclePv($id);
        $this->assign('article',$article);
        $this->display();
    }
}