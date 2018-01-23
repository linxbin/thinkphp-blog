# -----------------------------------------------------------
# Description:备份的数据表[结构] admin,article,auth_group,auth_group_access,auth_rule,channel,config,friendslink,menu,mould,soft,wx_config
# Description:备份的数据表[数据] admin,article,auth_group,auth_group_access,auth_rule,channel,config,friendslink,menu,mould,soft,wx_config
# Time: 2017-10-19 21:20:21
# -----------------------------------------------------------
# SQLFile Label：#1
# -----------------------------------------------------------


# 表的结构 admin 
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '账号名称',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `salt` varchar(6) NOT NULL DEFAULT '' COMMENT '加密盐',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '登录ip',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1开启，2禁止',
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='后台管理员表' ;

# 表的结构 article 
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '发布人',
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '标题',
  `thumb` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '缩略图',
  `description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COMMENT '内容',
  `keyword` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文章关键词',
  `channel_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属栏目id',
  `hot` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
  `top` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `pv` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='普通文章表' ;

# 表的结构 auth_group 
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='权限用户组表' ;

# 表的结构 auth_group_access 
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与节点连接表' ;

# 表的结构 auth_rule 
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` tinyint(3) unsigned DEFAULT NULL COMMENT '上级权限',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='权限节点管理表' ;

# 表的结构 channel 
DROP TABLE IF EXISTS `channel`;
CREATE TABLE `channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `title` char(30) NOT NULL COMMENT '栏目标题',
  `ename` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目别名',
  `keyword` varchar(100) NOT NULL DEFAULT '' COMMENT 'seo关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT 'seo描述',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '栏目排序',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态',
  `display` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mould` varchar(10) NOT NULL DEFAULT '' COMMENT '内容模型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='栏目数据表' ;

# 表的结构 config 
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置键',
  `value` text NOT NULL COMMENT '配置值',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置名称',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='参数配置表' ;

# 表的结构 friendslink 
DROP TABLE IF EXISTS `friendslink`;
CREATE TABLE `friendslink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='友情链接' ;

# 表的结构 menu 
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '99' COMMENT '排序',
  `controller` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='系统菜单表' ;

# 表的结构 mould 
DROP TABLE IF EXISTS `mould`;
CREATE TABLE `mould` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '模型名称',
  `tablename` varchar(20) NOT NULL DEFAULT '' COMMENT '对应数据表',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='模型管理表' ;

# 表的结构 soft 
DROP TABLE IF EXISTS `soft`;
CREATE TABLE `soft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '软件名称',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO描述',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `size` varchar(50) NOT NULL DEFAULT '' COMMENT '软件大小',
  `version` varchar(50) NOT NULL DEFAULT '' COMMENT '版本',
  `platform` varchar(100) NOT NULL DEFAULT '' COMMENT '使用平台',
  `channel_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属栏目id',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '发布人',
  `language` varchar(100) NOT NULL DEFAULT '' COMMENT '使用语言',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `download` varchar(255) NOT NULL DEFAULT '' COMMENT '下载地址',
  `content` text NOT NULL COMMENT '软件说明',
  `keyword` varchar(200) NOT NULL DEFAULT '' COMMENT 'seo关键词',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='软件管理表' ;

# 表的结构 wx_config 
DROP TABLE IF EXISTS `wx_config`;
CREATE TABLE `wx_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '配置名',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='微信配置表' ;



# 转存表中的数据：admin 
INSERT INTO `admin` VALUES ('9','admin','管理员','6022745975fe22d1cc1b784e12086557','UrX1Na','1489567781','1508416503','127.0.0.1','1','15');
INSERT INTO `admin` VALUES ('10','demo','游客1号','4ce08c427ccb7ed53a80a20ed680d9e8','blEdpT','1489629918','1504191027','127.0.0.1','1','7');
INSERT INTO `admin` VALUES ('11','admin23','审核员','1e2706fefc8b34f6d410ba20339adcf2','zpBsUO','1489629934','1489629934','127.0.0.1','1','0');
INSERT INTO `admin` VALUES ('12','admin123123','管理员助理','7f1c36f8ebefa77c84bace149f256655','YrJLAz','1489630008','1489630008','127.0.0.1','-1','0');
INSERT INTO `admin` VALUES ('13','asd','第三方','45a798dfd7e3bf908dccfe4c51cbe65f','wHtfGs','1489632481','1489632481','127.0.0.1','-1','0');
INSERT INTO `admin` VALUES ('14','22admin22','232323','0229ea2ac5754e3954de400c2420ed69','ZiILBp','1489632491','1489632491','127.0.0.1','-1','0');


# 转存表中的数据：article 
INSERT INTO `article` VALUES ('1','U执行','不同电脑设置U盘启动方法','/Uploads/ArticleImg/20170415/1492228314763045.png\"',' U盘装系统，U盘启动里最关键的一步就是设置U盘启动，本教程以某台型号的电脑为例进行BIOS设置，市场上不同电脑BIOS设置大同小异，U执行在这里给大家讲解下，如何设置U盘启动，希望能够起到抛砖引玉作用。','<p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">BIOS设置U盘启动方法：</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">&nbsp;</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"font-family: Calibri;\">1.&nbsp;</span><span style=\"letter-spacing: 0px;\">开机一般一直按着键盘上的Delete键,一些品牌电脑可能不是按Delete键,进Bios快捷 &nbsp; 键一般在电脑进行自检时,屏幕有显示进Bios设置界面提示信息，切换到Boot工具栏</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0\"><span style=\"letter-spacing: 0;font-size: 16px\">-&gt;hard drive bbs priorities-&gt;选择U盘为第一启动项-&gt;Esc返回Boot界面</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0\"><span style=\"letter-spacing: 0;font-size: 16px\"><br/></span></p><p><img src=\"//show.52meijie.com/Uploads/ArticleImg/20170415/1492228314763045.png\" style=\"width: 647px; height: 327px;\" title=\"1492228314763045.png\" width=\"647\" height=\"327\"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bios主界面</p><p><img src=\"//show.52meijie.com/Uploads/ArticleImg/20170415/1492228314840438.png\" style=\"\" title=\"1492228314840438.png\"/></p><p><span style=\"text-align: center;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bios启动项设置界面</span></p><p><span style=\"letter-spacing: 0px;\">2.设置完成后效果如下图所示</span><span style=\"letter-spacing: 0px;\">&nbsp; &nbsp;</span></p><p><span style=\"letter-spacing: 0px;\"><br/></span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">&nbsp;<img src=\"http://show.52meijie.com/Uploads/ArticleImg/20170415/1492228314497532.png\" title=\"1492228314497532.png\" style=\"white-space: normal;\"/></span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; U盘启动设置后效果</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">3.设置完成后记得保存设置，不同主板Bios设置界面都有保持设置快捷键提示,U执行小编的保存设置位F4,然后选择yes，如图</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><br/></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><img src=\"http://show.52meijie.com/Uploads/ArticleImg/20170415/1492228314409374.png\" title=\"1492228314409374.png\" style=\"white-space: normal; width: 652px; height: 338px;\" width=\"652\" height=\"338\"/></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;保存提示</p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">4.重启电脑后,从U盘启动，效果如图所示:</span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><span style=\"letter-spacing: 0;font-size: 16px\">&nbsp;<img src=\"http://show.52meijie.com/Uploads/ArticleImg/20170415/1492228314663689.png\" title=\"1492228314663689.png\" style=\"white-space: normal; width: 655px; height: 352px;\" width=\"655\" height=\"352\"/></span></p><p style=\"margin-top:5px;margin-right:0;margin-bottom:5px;margin-left:0;text-indent:0\"><br/></p><p><span style=\"letter-spacing: 0;font-size: 16px\"><span style=\"font-family:sans-serif\">本次</span>U执行小编介绍到此,更多精彩内容请关注</span><a href=\"http://www.uzhixing.net/\"><span style=\"text-decoration:underline;\"><span style=\"color: rgb(0, 0, 255);letter-spacing: 0;font-size: 16px\">U执行官网</span></span></a></p><p><br/></p>','u盘启动，U执行','8','0','0','1492228832','0','-1');
INSERT INTO `article` VALUES ('2','U执行','微星gl72笔记本使用bios设置u盘启动方法','/Uploads/ArticleImg/20170414/1492183879109963.jpg\"','微星gl72笔记本是一款性能非常强劲的游戏笔记本电脑,在游戏加载方面速度提升非常明显,在机身设计方面充分考虑玩家们的喜好,直角切边的硬朗线条和圆角的包边相互调和,形成了一众浑然一体的美感,那么这款微星gl72笔记本怎么使用bios设置u盘启动呢?还不懂的朋友一起来看看吧。','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;bios设置u盘启动方法：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;1、首先将u盘制作成u启动u盘启动盘，然后连接到电脑重启等待出现开机画面按下启动快捷键f11，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u盘启动盘\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183879109963.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 586px; height: 342px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;2、进入快捷启动项选择窗口，选择u盘所在位置，按回车键进入，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u盘启动\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183879100935.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 583px; height: 313px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;3、随后进入u启动主菜单，此时我们便可以使用u盘启动盘提供的更多功能了。<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u启动主菜单\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183879118001.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 369px; height: 450px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;好了,以上就是微星gl72笔记本使用<span style=\"color: rgb(255, 0, 0);\"><strong>bios设置u盘启动</strong></span>的详细步骤,操作方法很简单,有需要的朋友可以按照以上教程试试哦。</p><p><br/></p>','微星，bios','8','1','1','1492183897','0','-1');
INSERT INTO `article` VALUES ('3','U执行','戴尔v5480笔记本怎么使用bios设置u盘启动','/Uploads/ArticleImg/20170414/1492183825124620.jpg\"',' 戴尔v5480系列笔记本在外观设计方面时尚美观，这款笔记本采用的是超薄的机身设计，便于随身携带，娱乐办公十分便利，内嵌式电池使得背面一体化。在配置方面也是比较优秀的，充分满足了各种需求。那么这款戴尔v5480笔记本怎么设置u盘启动呢?今天就和大家分享戴尔v5480笔记本bios设置u盘启动的方法。','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">bios设置u盘启动方法：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;1、首先将u盘制作成u启动u盘启动盘，然后连接到电脑重启等待出现开机画面按下启动快捷键f12，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u盘启动盘\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183825124620.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 542px; height: 345px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;2、按下启动快捷键后系统进入到启动项选择窗口，利用键盘上的上下方向键选择u盘启动，其中usb开头的就是插入的u盘，按下回车键确认，如下图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u盘启动\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183825667767.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 538px; height: 297px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;3、等待电脑出现u启动主菜单即可完成u盘启动，如下图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u启动主菜单\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492183825140231.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 367px; height: 453px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;以上就是戴尔v5480笔记本使用<span style=\"color: rgb(255, 0, 0);\"><strong>bios设置u盘启动</strong></span>的详细步骤，如果有朋友碰到不懂设置u盘启动，可以按照上述方法步骤进行设置哦。</p><p><br/></p>','戴尔，bios','8','0','0','1492183833','0','-1');
INSERT INTO `article` VALUES ('4','U执行','今夏微软将推送win10红石正式版','/Uploads/ArticleImg/20170414/1492184430457384.jpg\"','【导读】win10正式版10586中的“系统文件检查器”（sfc.exe）错误问题一直未被解决，该程序用于系统文件检查与修复，现微软做出回应，将消除该问题，使系统文件错误得到解决。','<p>&nbsp; &nbsp; 熟悉windows的用户都知道，win10正式版中的这个sfc.exe程序一般用于系统文件的检查和修复。但在win10 th2正式版中，一个“小误会”导致了这个程序经常修复失败。微软表示，问题的关键在于opencl.dll。win10安装后自带一个该文件，而硬件驱动又会有自己的版本，驱动装完后就会替换掉win10自带的版本。所以如果你运行sfc.exe /scannow，会出现“windows资源保护发现错误的文件，但无法修复它们。”的提示，而且正像提示所说系统无法替换成原有版本。微软目前正在解决该问题。<br/></p><p>&nbsp;</p><p><img alt=\"\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170414/1492184430457384.jpg\" title=\"win10正式版\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 579px; height: 236px;\"/><br/>&nbsp;</p><p>&nbsp; &nbsp; 如果顺利的话，微软会在后续的累计更新中修复该问题。要想使用这个功能，你可以右键单击开始按钮，选择“命令提示符（管理员）”，然后输入sfc.exe /scannow后按回车键执行，等待执行完毕即可。win10正式版发布至今的确不少bug，但是这些bug一直都会被“消灭”，相信微软也会尽快把系统文件错误这个长期解决不掉的bug“消灭”。</p><p><br/></p>','微软，window10','3','0','0','1492184460','0','-1');
INSERT INTO `article` VALUES ('5','U执行','win10正式版系统文件错误将消除','/Uploads/ArticleImg/20170414/1492184539352989.jpg\"','【导读】win10正式版10586中的“系统文件检查器”（sfc.exe）错误问题一直未被解决，该程序用于系统文件检查与修复，现微软做出回应，将消除该问题，使系统文件错误得到解决。','<p>&nbsp;&nbsp;熟悉windows的用户都知道，win10正式版中的这个sfc.exe程序一般用于系统文件的检查和修复。但在win10 th2正式版中，一个“小误会”导致了这个程序经常修复失败。微软表示，问题的关键在于opencl.dll。win10安装后自带一个该文件，而硬件驱动又会有自己的版本，驱动装完后就会替换掉win10自带的版本。所以如果你运行sfc.exe /scannow，会出现“windows资源保护发现错误的文件，但无法修复它们。”的提示，而且正像提示所说系统无法替换成原有版本。微软目前正在解决该问题。<br/></p><p>&nbsp;</p><p><br/>&nbsp;</p><p>&nbsp; &nbsp; 如果顺利的话，微软会在后续的累计更新中修复该问题。要想使用这个功能，你可以右键单击开始按钮，选择“命令提示符（管理员）”，然后输入sfc.exe /scannow后按回车键执行，等待执行完毕即可。win10正式版发布至今的确不少bug，但是这些bug一直都会被“消灭”，相信微软也会尽快把系统文件错误这个长期解决不掉的bug“消灭”。</p><p><br/></p>','微软，window10，123','13','1','0','1493038959','0','-1');
INSERT INTO `article` VALUES ('6','U执行','设置win10屏幕自动关闭','/Uploads/ArticleImg/20170415/1492235597720782.jpg\"','电脑没使用一段时间之后，电脑会自动处于休眠或者锁屏的状态，不仅节约电量而且对屏幕也是一种保护，不过在win10系统中我们可以直接自己来设置关闭屏幕时间，接下来就给大家详细介绍win10屏幕自动关闭设置方法。','<p>　　1、在桌面上打开开始菜单,选择“设置”选项，如下图所示：<br/></p><p>&nbsp;</p><p><img alt=\"\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235597720782.jpg\" title=\"屏幕自动关闭\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 230px; height: 271px;\"/></p><p>&nbsp;</p><p>　　2、在打开的设置窗口中，点击“系统”，如下图所示：<br/>&nbsp;</p><p><img alt=\"\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235598109614.jpg\" title=\"屏幕自动关闭\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 600px; height: 350px;\"/></p><p>&nbsp;</p><p>　　3、在打开的系统窗口界面中，切换到“电源和睡眠”栏，再右侧窗口中设置屏幕自动关闭的时间，我们可以选择一个适合自己使用情况的时间，如下图所示：<br/>&nbsp;</p><p><img alt=\"\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235599443227.jpg\" title=\"屏幕自动关闭\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 600px; height: 315px;\"/></p><p>&nbsp;</p><p>　　以上便是设置win10<strong><span style=\"color: rgb(255, 0, 0);\">屏幕自动关闭</span></strong>的方法，还有不知道如何设置自动关闭屏幕时间的用户不妨参考上面步骤进行尝试操作。</p><p><br/></p>','window10，U执行','15','0','0','1493038922','0','-1');
INSERT INTO `article` VALUES ('7','U执行','win8系统快速转换u盘hdd模式教程','/Uploads/ArticleImg/20170415/1492235758101529.jpg\"',' usb hdd模式指的是u盘模拟成硬盘模式，做为装系统的一种启动模式，usb hdd启动方式现在也被许多用户使用。不过如果u盘不是hdd格式的情况下应该怎么办呢?我们可以使用diskgenius软件来转换格式，今天就和大家分享转换u盘hdd模式的方法。\n ','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;u盘hdd模式转换操作方法：<br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;1、可以到u启动官网下载u盘启动盘制作工具，然后制作一个u盘启动盘，按开机启动快捷键进入u启动主菜单界面，选择【02】u启动win8pe标准版(新机器)并回车，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"u启动主菜单\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235758101529.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 389px; height: 211px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;2、双击打开桌面diskgenius分区工具图标进入分区工具中，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"diskgenius\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235759437547.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 325px; height: 227px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;3、在diskgenius分区工具中，先选定u盘，然后依次点击工具--转换为hdd模式，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"hdd模式\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235759186843.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 598px; height: 426px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;4、弹出提示框提醒是否确定要转换成hdd模式，直接点击是即可，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"提示框\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235760814161.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 491px; height: 185px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;5、之后弹出hdd模式转换完成，是否立即创建可引导分区提醒框，直接点击是，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"转换完成\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235760776723.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 371px; height: 171px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;6、建立新分区窗口中，可根据自身情况进行设置，然后点击确定，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"建立新分区\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235760592805.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 380px; height: 420px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;7、hdd模式转换完成，提示重新拔插u盘，点击确定即可，如图所示：<br/>&nbsp;</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img alt=\"转换完成\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235761802026.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 492px; height: 169px;\"/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; word-wrap: break-word; overflow: hidden; color: rgb(102, 102, 102); font-size: 14px; width: 818px; font-family: 微软雅黑, &#39;Arial Narrow&#39;, HELVETICA; line-height: 25px; text-indent: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;u盘hdd模式转换方式就详细为大家分享到这里了，如果有不会的朋友可以按照上述方法步骤进行操作，除了对<span style=\"color: rgb(255, 0, 0);\"><strong>u盘hdd模式</strong></span>的转换之外，diskgenius软件还有很多其功能，大家可以试试哦。</p><p><br/></p>','window8','17','0','0','1493020588','0','-1');
INSERT INTO `article` VALUES ('8','U执行','win7电脑无法识别u盘解决方法','/Uploads/ArticleImg/20170415/1492235968372741.jpg\"','如今u盘是广大用户们存储数据资料的必备工具,在科技发展的时代,虽然有很多的云服务、云存储,但是都没u盘来得安全可靠。可是当电脑无法识别u盘是不是就不能使用了呢?其实我们可以通过一些渠道来让u盘被识别,今天就和大家分享win7电脑无法识别u盘的解决方法。\n ','<p>无法识别u盘解决方法：<br/></p><p>&nbsp;</p><p>&nbsp; &nbsp;1、鼠标右键点击计算机图标，在弹出的菜单中点击属性，在弹出的窗口中，点击左侧设备管理器，如图所示：<br/>&nbsp;</p><p><img alt=\"设备管理器\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235968372741.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 568px; height: 319px;\"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp;<br/>&nbsp; &nbsp; &nbsp; &nbsp;2、接着在设备管理器窗口中点击通用串行总线控制器，然后右键点击usb root hub选项，先设置成禁用，再设置成启用。如图所示：<br/>&nbsp;</p><p><img alt=\"禁用usb\" src=\"//tp.linxb.com/Uploads/ArticleImg/20170415/1492235969564749.jpg\" data-bd-imgshare-binded=\"1\" style=\"border: none; vertical-align: middle; display: block; margin: 0px auto; width: 476px; height: 579px;\"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp;<br/>&nbsp; &nbsp; &nbsp; &nbsp;win7电脑无法识别u盘的详细解决方法就为大家介绍到这里了，如果有朋友碰到同样问题可以按照上述方法进行解决，希望本篇教程能够帮到大家。</p><p><br/></p>','U执行','12','0','0','1493042421','0','-1');
INSERT INTO `article` VALUES ('9','U执行','win7系统下怎么解除u盘被屏蔽','/Uploads/ArticleImg/20170415/1492236044306601.jpg\"','在win7系统下使用u盘的时候系统无法识别u盘这种问题是不是有很多用户遇到过呢?如果u盘没有坏,那么就是u盘被屏蔽了,要想知道怎么解除被系统屏蔽的u盘吗?不懂的朋友一起来看看吧。','<p>&nbsp;&nbsp;&nbsp;&nbsp;u盘被屏蔽解决步骤：<br/>&nbsp;</p><p>&nbsp; &nbsp;1、按快捷键win+r打开运行窗口，输入regedit点击确定，如图所示：<br/>&nbsp;　　</p><p>&nbsp; &nbsp; &nbsp; &nbsp;2、在注册表编辑器中，依次展开HKEY_LOCAL_MACHINE\\SYSTEM\\CurrentControlSet\\services\\USBSTOR，在右侧窗口找到start选项，如图所示：<br/>&nbsp;</p><p><br/></p><p>　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;3、双击打开start选项，将数值数据改为3，其余保持不变，然后点击确定即可，如图所示：<br/>&nbsp;</p><p><br/></p><p>　　<br/>&nbsp; &nbsp; &nbsp; &nbsp;win7系统下u盘被屏蔽的解决方法就为大家分享到这里了，如果有用户使用u盘时系统无法识别u盘，可以先用上述方法检查看看u盘是否被屏蔽了，希望本篇教程能够帮到大家。</p><p><br/></p>','问题，window7','16','0','0','1493040568','0','-1');
INSERT INTO `article` VALUES ('10','sadf','sadf','','adsf','<p>sdaf</p>','asdf','2','0','1','1492745103','0','-1');
INSERT INTO `article` VALUES ('11','1234','更改Win10系统计算机上的OneNote的默认版本','','Windows 10附带OneNote应用程序。 如果您的计算机上还安装了OneNote 2016，则最终将安装两个OneNote软件。 这篇文章将告诉你如何使任一版本作为默认打开您的OneNotes。','<p><strong style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\">更改OneNote的默认版本</strong><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp; &nbsp;当您启动OneNote注意事项时，Windows 10将检测两个版本的OneNote应用程序，因此提示您选择要用作打开未来笔记本的默认应用程序的版本。 然后，您需要进行选择。 如果您希望以后随时更改默认值，您可以按照以下步骤操作。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">打开开始菜单，然后选择设置。 选择系统，选择“默认应用”，然后滚动到列表底部，找到“按照应用设置默认值”条目。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp;&nbsp; 单击此链接，并在“设置默认程序”下的列表中，找到您希望Windows用作默认应用程序的OneNote版本，并选择“将此程序设置为默认值”。 例如，如果您想在OneNote 2016中始终打开笔记本，请选择OneNote（桌面）。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp;&nbsp; 单击“确定”保存更改。 此后，如果您想在任何给定时间更改这些设置，请重复上述列表中的步骤，然后选择不同的选项。或者，您也可以使用Internet Explorer在Windows 10中打开OneNote链接，或使用OneNote Online打开OneNote应用程序或将其设置为默认版本。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp; &nbsp;要设置从Web打开的OneNote的版本，请打开设置，选择系统&gt;默认应用程序，滚动到列表的底部，然后选择“按协议选择默认应用程序”。在这里，向下滚动以查找OneNote协议，然后单击ONENOTE URL：OneNote协议图标。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp;&nbsp; 完成后，从“选择应用程序”对话框中选择OneNote 2016（桌面应用程序），然后单击ONENOTEDESKTOP URL：OneNote协议图标，并在出现的选择应用程序对话框中选择OneNote 2016（桌面应用程序）。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">&nbsp;&nbsp;&nbsp;&nbsp;关闭“按协议选择默认应用”窗口。 现在，当您使用Internet Explorer在Windows 10中打开链接或从OneNote Online打开OneNote时，您将看到OneNote 2016打开。</span><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><br style=\"margin: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\"/><span style=\"color: rgb(102, 102, 102); font-family: 宋体; font-size: 14px; background-color: rgb(248, 250, 251);\">小编本次介绍到此&nbsp; 更多帮助请关注&nbsp;</span><a href=\"http://www.uzhixing.com/\" style=\"margin: 0px; padding: 0px; color: rgb(23, 44, 69); text-decoration: none; outline: none; font-family: 宋体; font-size: 14px; white-space: normal; background-color: rgb(248, 250, 251);\">www.uzhixing.com</a></p>','更改Win10系统计算机上的OneNote的默认版本','17','0','0','1493021996','0','-1');
INSERT INTO `article` VALUES ('12','asdf','asdfasdfa','','asdf','<p>asdfasd</p>','sdf','19','0','1','1493709536','0','0');
INSERT INTO `article` VALUES ('13','linxb','只有程序员才懂的幽默','/Uploads/ArticleImg/20170505/1493965293113354.png\"','asdfa','<p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"//tpcms.linxb.com/Uploads/ArticleImg/20170505/1493965293113354.png\" alt=\"只有程序员才懂的幽默\" style=\"border: 0px; margin: 0px; padding: 0px; max-width: 100%; height: auto;\"/></p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"border: 0px; margin: 0px; padding: 0px;\">以下是关于程序员的一些笑话，据说看懂的人都还在加班中。</strong></p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">1. 老婆给当程序员的老公打电话：下班顺路买十个包子，如果看到卖西瓜的，买一个。当晚老公手捧一个包子进了家门。老婆怒道：你怎么只买一个包子？！老公甚恐，喃喃道：因为我真看到卖西瓜的了。&quot;</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">2. 一程序员去面试，面试官问：&quot;你毕业才两年，这三年工作经验是怎么来的？！&quot;程序员答：&quot;加班。&quot;</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">3. 某程序员对书法十分感兴趣，退休后决定在这方面有所建树。于是花重金购买了上等的文房四宝。一日，饭后突生雅兴，一番磨墨拟纸，并点上了上好的檀香，颇有王羲之风范，又具颜真卿气势，定神片刻，泼墨挥毫，郑重地写下一行字：hello world。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">4. 问：程序员最讨厌康熙的哪个儿子。答：胤禩。因为他是八阿哥（bug）</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">5. 程序猿要了3个孩子，分别取名叫Ctrl、Alt 和Delete，如果他们不听话，程序猿就只要同时敲他们一下就会好的。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">6. 今天在公司听到一句惨绝人寰骂人的话：&quot;你TM就是一个没有对象的野指针！&quot;</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">7. 程xx遭遇车祸成植物人，医生说她活下来的希望只有万分之一，唤醒更为渺茫。她的同事和亲人没放弃，并根据程xx对testing痴迷的作风，每天都在她身边念：&quot;你测的模块上线后回滚了。&quot;奇迹发生了，程xx醒来第一句话：确认那模块是我测的？ &nbsp; 8. 一个程序员在海滨游泳时溺水身亡。他死前拼命的呼救，当时海滩上有许多救生员，但是没有人救他。因为他一直大喊&quot;F1!&quot;&quot;F1!&quot;，谁都不知道&quot;F1&quot;究竟是什么意思。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">9. 世界上最远的距离，是我在if里你在else里，虽然经常一起出现，但却永不结伴执行。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">10. 正在码代码ing，医院回来的同事一脸的苦逼样子，问他怎么了？他回答：得了类风湿性关节炎了，我怕会遗传给下一代啊。我一脸的问号：谁说类风湿性关节炎能遗传的？丫一脸诧异：类不是继承的吗？</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">11. 我很奇怪客栈这个词，难道后入住的必须先退房吗？</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">12. 话说，决定一个程序员跳槽与否的关键因素是他前同事的现工资。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">13. 程序员最憋屈的事情就是：你辛辛苦苦熬夜写了一个风格优雅的源文件，被一个代码风格极差的同事改了且没署名，以至于别人都以为你是写的。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">14. 前端工程师说，我去交友网站找女朋友去了。朋友问，找到了么？工程师说，找到了他们页面的一个bug。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">15. C程序员看不起C++程序员， C++程序员看不起Java程序员， Java程序员看不起C#程序员，C#程序员看不起美工，周末了，美工带着妹子出去约会了，一群程序员还在加班！</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">16. 据说一老外年轻的时候，立志要当一名伟大的作家。怎么才算伟大呢？他说：我写的东西全世界都要看到！看完他们必定会歇斯底里！会火冒三丈！会痛苦万分！结果，他成功了，他在微软公司负责写系统蓝屏时的报错提示信息。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">17. 程序员应聘必备词汇：了解＝听过名字；熟悉＝知道是啥；熟练＝用过；精通＝做过东西。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">18. 两程序员聊天，程序员甲抱怨：&quot;做程序员太辛苦了，我想换行……我该怎么办？&quot;程序员乙：&quot;敲一下回车。&quot;</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">19. 程序员最讨厌的四件事：写注释、写文档、别人不写注释、别人不写文档……</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; font-size: 14px; font-family: &quot;Microsoft Yahei&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">20. 假如生活欺骗了你，找50个程序员问问为什么编程；假如生活让你想死，找50个程序员问问Bug改完了没有；假如你觉得生活拮据，找50个程序员问问工资涨了没有；假如你觉得活着无聊，找50个程序员问问他们一天都干了什么！</p><p><br/></p>','f','20','1','1','1508419061','0','0');


# 转存表中的数据：auth_group 
INSERT INTO `auth_group` VALUES ('1','超级管理员','1','1,2,22,3,7,23,24,25,40,41,45,46,47,48,49,50,5,10,26,27,28,11,29,30,31,12,35,36,37,38,13,32,33,34,51,52,54,55,56,57,58,59,60,61,62,63,64,68,69,70,71,65,66,67','1489998939');
INSERT INTO `auth_group` VALUES ('2','版主','1','1,2,22,5,10,26,27,28,11,29,30,31,12,35,36,37,38,13,32,33,34,51,52,54,55,56,65,66,67','1489483097');
INSERT INTO `auth_group` VALUES ('3','信息审核员','1','1,2,3,7,5,10,26,27,28,11,29,30,31,12,38,35,36,37,13,32,33,34','1489998424');
INSERT INTO `auth_group` VALUES ('4','游客','1','5,10,26,27,28,11,29,30,31,12,38,35,36,37,13,32,33,34','1492592698');
INSERT INTO `auth_group` VALUES ('5','测试二组','1','1,2,22,3,7,23,24,25,40,41,45,46,5,10,26,27,28,11,29,30,31,12,35,36,37,38,13,32,33,34','1489645881');
INSERT INTO `auth_group` VALUES ('6','测试三组','-1','','1489642838');
INSERT INTO `auth_group` VALUES ('7','测试四组','-1','','1489635741');
INSERT INTO `auth_group` VALUES ('8','asdfasd','-1','','1489639987');


# 转存表中的数据：auth_group_access 
INSERT INTO `auth_group_access` VALUES ('9','1');
INSERT INTO `auth_group_access` VALUES ('10','1');
INSERT INTO `auth_group_access` VALUES ('11','1');
INSERT INTO `auth_group_access` VALUES ('12','1');
INSERT INTO `auth_group_access` VALUES ('13','2');
INSERT INTO `auth_group_access` VALUES ('14','1');


# 转存表中的数据：auth_rule 
INSERT INTO `auth_rule` VALUES ('1','0','#','系统管理','1','1','','1492744005');
INSERT INTO `auth_rule` VALUES ('2','1','/config/index','查看配置','1','1','','1492590730');
INSERT INTO `auth_rule` VALUES ('3','0','#','内容管理','1','1','','1492744012');
INSERT INTO `auth_rule` VALUES ('5','0','#','系统权限','1','1','','1492744024');
INSERT INTO `auth_rule` VALUES ('7','3','/channel/index','栏目管理','1','1','','1492590744');
INSERT INTO `auth_rule` VALUES ('10','5','/menu/index','系统菜单','1','1','','1492590919');
INSERT INTO `auth_rule` VALUES ('11','5','/user/index','系统用户','1','1','','1489648164');
INSERT INTO `auth_rule` VALUES ('12','5','/auth/group','用户组设定','1','1','','1489648157');
INSERT INTO `auth_rule` VALUES ('13','5','/auth/rules','节点管理','1','1','','1489745467');
INSERT INTO `auth_rule` VALUES ('22','2','/config/set','修改','1','1','','1492590737');
INSERT INTO `auth_rule` VALUES ('23','7','/channel/add','添加','1','1','','1492590749');
INSERT INTO `auth_rule` VALUES ('24','7','/channel/edit','修改','1','1','','1492590756');
INSERT INTO `auth_rule` VALUES ('25','7','/channel/drop','删除','1','1','','1492590868');
INSERT INTO `auth_rule` VALUES ('26','10','/menu/add','增加','1','1','','1492590926');
INSERT INTO `auth_rule` VALUES ('27','10','/menu/edit','编辑','1','1','','1492588087');
INSERT INTO `auth_rule` VALUES ('28','10','/menu/drop','删除','1','1','','1492588128');
INSERT INTO `auth_rule` VALUES ('29','11','/user/add','增加用户','1','1','','1492588135');
INSERT INTO `auth_rule` VALUES ('30','11','/user/edit','编辑','1','1','','1492588144');
INSERT INTO `auth_rule` VALUES ('31','11','/user/drop','删除','1','1','','1492588203');
INSERT INTO `auth_rule` VALUES ('32','13','/auth/ruleadd','添加','1','1','','1492588222');
INSERT INTO `auth_rule` VALUES ('33','13','/auth/ruleedit','修改','1','1','','1492590963');
INSERT INTO `auth_rule` VALUES ('34','13','/auth/ruledrop','删除','1','1','','1492590958');
INSERT INTO `auth_rule` VALUES ('35','12','/auth/groupadd','添加','1','1','','1492588150');
INSERT INTO `auth_rule` VALUES ('36','12','/auth/groupedit','修改','1','1','','1492588234');
INSERT INTO `auth_rule` VALUES ('37','12','/auth/groupdrop','删除','1','1','','1492588248');
INSERT INTO `auth_rule` VALUES ('38','12','/auth/apply','访问授权','1','1','','1492588229');
INSERT INTO `auth_rule` VALUES ('40','3','/article/index','普通文章','1','1','','1492590874');
INSERT INTO `auth_rule` VALUES ('41','40','/article/add','添加文章','1','1','','1492590880');
INSERT INTO `auth_rule` VALUES ('45','40','/article/edit','编辑文章','1','1','','1492590886');
INSERT INTO `auth_rule` VALUES ('46','40','/article/drop','删除文章','1','1','','1492590891');
INSERT INTO `auth_rule` VALUES ('47','3','/soft/index','软件管理','1','1','','1492590897');
INSERT INTO `auth_rule` VALUES ('48','47','/soft/add','软件发布','1','1','','1492590902');
INSERT INTO `auth_rule` VALUES ('49','47','/soft/edit','编辑','1','1','','1492590907');
INSERT INTO `auth_rule` VALUES ('50','47','/soft/drop','软件删除','1','1','','1492590913');
INSERT INTO `auth_rule` VALUES ('51','0','/addons/index','插件管理','1','1','','1492590952');
INSERT INTO `auth_rule` VALUES ('52','51','/addons/friendslink','友情链接','1','1','','1492590947');
INSERT INTO `auth_rule` VALUES ('54','52','/addons/friendslinkadd','添加','1','1','','1492590942');
INSERT INTO `auth_rule` VALUES ('55','52','/addons/friendslinkedit','编辑','1','1','','1492590936');
INSERT INTO `auth_rule` VALUES ('56','52','/addons/friendslinkdrop','删除','1','1','','1492590931');
INSERT INTO `auth_rule` VALUES ('57','0','#','扩展管理','1','1','','1493715800');
INSERT INTO `auth_rule` VALUES ('58','57','/database/index','数据库管理','1','1','','1493715823');
INSERT INTO `auth_rule` VALUES ('59','58','/database/optimize','数据表优化','1','1','','1493776052');
INSERT INTO `auth_rule` VALUES ('60','58','/database/repair','数据表修复','1','1','','1493776079');
INSERT INTO `auth_rule` VALUES ('61','58','/database/restore','还原管理','1','1','','1493783445');
INSERT INTO `auth_rule` VALUES ('62','58','/database/backup','备份','1','1','','1493790715');
INSERT INTO `auth_rule` VALUES ('63','58','/database/delsqlfiles','删除备份文件','1','1','','1493860196');
INSERT INTO `auth_rule` VALUES ('64','58','/database/restoredata','数据恢复','1','1','','1493860598');
INSERT INTO `auth_rule` VALUES ('65','0','#','微信管理','1','1','','1493867413');
INSERT INTO `auth_rule` VALUES ('66','65','/weixin/index','配置管理','1','1','','1493878153');
INSERT INTO `auth_rule` VALUES ('67','66','/weixin/basic','修改接口配置','1','1','','1493887729');
INSERT INTO `auth_rule` VALUES ('68','57','/mould/index','模型管理','1','1','','1493947038');
INSERT INTO `auth_rule` VALUES ('69','68','/mould/add','模型添加','1','1','','1493972674');
INSERT INTO `auth_rule` VALUES ('70','68','/mould/edit','模型编辑','1','1','','1493972691');
INSERT INTO `auth_rule` VALUES ('71','68','/mould/drop','模型删除','1','1','','1493975759');


# 转存表中的数据：channel 
INSERT INTO `channel` VALUES ('1','下载中心','xzzx','13123','1231','0','-1','1','0','soft');
INSERT INTO `channel` VALUES ('2','U盘教程','special','123','123123','0','-1','1','0','article');
INSERT INTO `channel` VALUES ('3','新闻资讯','xwzx','123','123','0','-1','1','0','article');
INSERT INTO `channel` VALUES ('4','软件下载','rjxz','123','123','0','-1','1','0','soft');
INSERT INTO `channel` VALUES ('5','常见问题','cjwt','sd','sd','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('6','媒体新闻','','','','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('7','u执行使用教程','','','','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('8','BIOS设置教程','','','','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('9','帮助中心','','','','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('10','个是梵蒂冈',' 啥地方','','','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('11','测试栏目','ceshi','测试','三连发吉林省发牢骚发牢骚登录','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('12','使用教程','syjc','123123','123123','0','-1','1','0','article');
INSERT INTO `channel` VALUES ('13','文章中心','wzzx','123123','123123','0','-1','1','0','article');
INSERT INTO `channel` VALUES ('14','下载中心','xzzx','12312','123123','0','-1','1','0','soft');
INSERT INTO `channel` VALUES ('15','帮助中心','bzzx','123123','123123','0','-1','1','0','article');
INSERT INTO `channel` VALUES ('16','常见问题','cjwt','123123','123123','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('17','最新动态','zxdt','123123','123213','0','-1','0','0','article');
INSERT INTO `channel` VALUES ('18','mysql数据库','mysql','mysql','mysql','0','1','1','0','article');
INSERT INTO `channel` VALUES ('19','php语言','php','php','php','0','1','1','0','article');
INSERT INTO `channel` VALUES ('20','linux服务器','linux','linux','linux','0','1','1','0','article');
INSERT INTO `channel` VALUES ('21','软件下载','rjxz','呵呵哒','呵呵哒','0','-1','1','0','soft');


# 转存表中的数据：config 
INSERT INTO `config` VALUES ('38','WEB_TITLE','我的网站','网站标题','');
INSERT INTO `config` VALUES ('39','WEB_KEY','我的网站','网站关键词','');
INSERT INTO `config` VALUES ('40','WEB_DESCRIPTION','我的网站','网站描述','');
INSERT INTO `config` VALUES ('41','WEB_COPYRIGHT','我的网站','网站版权信息','');
INSERT INTO `config` VALUES ('42','WEB_TCP','','网站备案信息','');
INSERT INTO `config` VALUES ('43','WEB_TONGJI','','网站统计代码','');
INSERT INTO `config` VALUES ('44','WX_URL','123123','公众号服务器url','');
INSERT INTO `config` VALUES ('45','WX_APPID','123123','公众号应用appid','');
INSERT INTO `config` VALUES ('46','WX_APPSECRET','123123','公众号appsecret','');
INSERT INTO `config` VALUES ('47','WX_TOKEN','12','公众号token','');
INSERT INTO `config` VALUES ('48','WX_ENCODING_AESKEY','123','公众号消息加密密钥','');


# 转存表中的数据：friendslink 
INSERT INTO `friendslink` VALUES ('1','系统之都123','http://www.xitongzhidu.cn','1492745682','-1');
INSERT INTO `friendslink` VALUES ('2','U执行一键重装','http://www.uzhixing.com','1492163066','-1');
INSERT INTO `friendslink` VALUES ('3','11','1','1492588300','-1');
INSERT INTO `friendslink` VALUES ('4','的固定','打工皇帝','1492591547','-1');
INSERT INTO `friendslink` VALUES ('5','123123','123','1492592210','-1');
INSERT INTO `friendslink` VALUES ('6','asdf','asdf','1492745128','-1');
INSERT INTO `friendslink` VALUES ('7','as','sd','1506611687','-1');


# 转存表中的数据：menu 
INSERT INTO `menu` VALUES ('10','网站设置','12','1','99','Config','index');
INSERT INTO `menu` VALUES ('11','系统菜单','17','1','99','Menu','index');
INSERT INTO `menu` VALUES ('12','系统管理','0','1','99','#','#');
INSERT INTO `menu` VALUES ('13','内容管理','0','1','99','#','#');
INSERT INTO `menu` VALUES ('17','系统权限','0','1','99','#','#');
INSERT INTO `menu` VALUES ('19','系统用户','17','1','99','User','index');
INSERT INTO `menu` VALUES ('21','栏目管理','13','1','99','Channel','index');
INSERT INTO `menu` VALUES ('23','用户组设定','17','1','99','Auth','group');
INSERT INTO `menu` VALUES ('24','节点管理','17','1','99','Auth','rules');
INSERT INTO `menu` VALUES ('27','文章管理','13','1','99','Article','index');
INSERT INTO `menu` VALUES ('28','软件管理','13','1','99','Soft','index');
INSERT INTO `menu` VALUES ('30','插件管理','0','1','99','Addons','index');
INSERT INTO `menu` VALUES ('31','友情链接','30','1','99','Addons','friendslink');
INSERT INTO `menu` VALUES ('32','合作伙伴','0','-1','99','','');
INSERT INTO `menu` VALUES ('33','扩展管理','0','1','99','#','#');
INSERT INTO `menu` VALUES ('34','数据库管理','33','1','99','Database','index');
INSERT INTO `menu` VALUES ('35','微信管理','0','1','99','#','#');
INSERT INTO `menu` VALUES ('36','配置管理','35','1','99','Weixin','index');
INSERT INTO `menu` VALUES ('37','模型管理','33','1','99','Mould','index');


# 转存表中的数据：mould 
INSERT INTO `mould` VALUES ('1','文章模型','article','普通文章模型','1','1');
INSERT INTO `mould` VALUES ('2','软件下载模型','soft','软件下载模型','1','1');
INSERT INTO `mould` VALUES ('3','产品模型','product','产品模型','1','99');


# 转存表中的数据：soft 
INSERT INTO `soft` VALUES ('1','u执行7.0u盘启动盘制作工具uefi版下载','<p>  u启动7.0u盘启动盘制作工具','/Uploads/Files/20170424/58fdb25ec0372.jpg','90M','1.1.0','window,xp,pc','14','1234','简体中文','10000','1493042761','[{\"url\":\"www.hao123.com\",\"name\":\"\\u672c\\u5730\\u4e0b\\u8f7d\"},{\"url\":\"www.hao123.com\",\"name\":\"\\u7535\\u4fe1\\u4e0b\\u8f7d\"},{\"url\":\"www.hao123.com\",\"name\":\"\\u767e\\u5ea6\\u7f51\\u76d8\"}]','<p>&nbsp; &nbsp; &nbsp;234123142341234</p>','U执行，下载，关键词','-1');
INSERT INTO `soft` VALUES ('2','asdf','123123 额 额额','/Uploads/Files/20170424/58fdb25174355.png','asdf','asdf','sadf','14','123132','繁体中文','123','1493021272','[{\"url\":\"asdf\",\"name\":\"asdf\"}]','<p>当前位置：<a href=\"http://www.cssmoban.com/\" target=\"_parent\">模板之家</a>&nbsp;&gt;&gt;&nbsp;<a href=\"http://www.cssmoban.com/cssthemes/\" target=\"_parent\">CSS模板</a>&nbsp;&gt;&gt;&nbsp;<a href=\"http://www.cssmoban.com/cssthemes/html5moban/\" target=\"_parent\">HTML5模板</a>&nbsp;&gt;&gt; 浏览文章</p><p><iframe id=\"iframe3641035_0\" src=\"about:blank\" vspace=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\" frameborder=\"0\" allowtransparency=\"true\"></iframe></p><p><a href=\"http://www.cssmoban.com/cssthemes/5114.shtml\" title=\"简约生活个人家庭摄影企业网站模板\">站模板</a>额额额额</p><p><br/></p>','asdfa eev','-1');


# 转存表中的数据：wx_config 
INSERT INTO `wx_config` VALUES ('1','WX_URL','http://www.weiysw.com/','公众号服务器url');
INSERT INTO `wx_config` VALUES ('2','WX_APPID','wx661dc93d0ea174f0','公众号应用appid');
INSERT INTO `wx_config` VALUES ('3','WX_APPSECRET','568785425340e06e7f66ef49cf07648d','公众号appsecret');
INSERT INTO `wx_config` VALUES ('4','WX_TOKEN','test123','公众号token');
INSERT INTO `wx_config` VALUES ('5','WX_ENCODING_AESKEY','JIyC7YWzO67FWEHBFyXIyn0MzwKUSRAbEmnZx8UXra0','公众号消息加密密钥');
