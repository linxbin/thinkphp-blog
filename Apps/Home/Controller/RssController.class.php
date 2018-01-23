<?php
/**
 * Created by PhpStorm.
 * User: Yumkai
 * Date: 2017/10/27
 * Time: 下午10:09
 */
namespace Home\Controller;

use Common\Logic\ArticleLogic;

class RssController extends InitController
{
    public function index()
    {
        $ArticleLogic = new ArticleLogic();
        $data = $ArticleLogic -> getArticList($params='', $page='', $this->errorFunc());

        $rss_xml = '<?xml version="1.0" encoding="utf-8"?>
            <rss version="2.0">
            <channel>
            <title>linxb</title>
            <description></description>
            <link>http://www.linxb.top</link>
            <generator>http://www.linxb.top</generator>';

        foreach( $data['list'] as $k => $v ) {
            $rss_xml .= "<item>
                <title><![CDATA[$v[title]]]></title>
                <link> " . 'http://'.$_SERVER['HTTP_HOST']. $v['url'] . "</link>
                <description> " . $v['content']  . "</description>
                <pubDate> ". date('Y-m-d H:i:s',$v['time']) ."</pubDate>
                <author> ". $v['author'] ."</author>
                <guid>" . 'http://'.$_SERVER['HTTP_HOST'] . $v['url'] . "</guid>
                </item>";
        }
        echo $rss_xml;
    }
}