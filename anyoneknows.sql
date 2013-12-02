-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 11 月 13 日 11:54
-- 服务器版本: 5.5.32
-- PHP 版本: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `anyoneknows`
--
CREATE DATABASE IF NOT EXISTS `anyoneknows` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci;
USE `anyoneknows`;

-- --------------------------------------------------------

--
-- 表的结构 `accept`
--

CREATE TABLE IF NOT EXISTS `accept` (
  `qid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `qid` (`qid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- 转存表中的数据 `accept`
--

INSERT INTO `accept` (`qid`, `aid`, `time`) VALUES
(3, 16, '2013-10-24 11:57:56'),
(7, 21, '2013-10-29 07:43:01'),
(8, 22, '2013-10-30 09:50:56');

-- --------------------------------------------------------

--
-- 表的结构 `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`),
  KEY `qid` (`qid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `answer`
--

INSERT INTO `answer` (`aid`, `uid`, `qid`, `content`, `time`) VALUES
(16, 8, 3, '<p>用$.post(url,data,success)&lt;br&gt;其中url为请求接收地址, data为POST数据,JSON格式, success为回调函数,可带一个参数为返回的数据</p>', '2013-10-24 11:55:34'),
(17, 8, 3, '<p>jQuery的话就是post,get和ajax吧</p>', '2013-10-24 11:55:38'),
(18, 9, 4, '<p>用$1, $2, $3 取组</p><p>如: &quot;$1-$2-$3&quot;=&gt;&quot;156-5176-8870&quot;</p>', '2013-10-24 11:55:43'),
(19, 9, 3, '<p>jQuery.post</p><p>jQuery.get</p><p>jQuery.ajax</p>', '2013-10-24 11:55:47'),
(20, 9, 6, '<pre class="brush:java;toolbar:false">jFrame.setUndecorated(true);</pre>', '2013-10-24 12:08:28'),
(21, 8, 7, '<pre class="brush:java;toolbar:false">jFrame.setUndecorated(true);</pre>', '2013-10-29 07:42:36'),
(22, 8, 8, '<p>MineCraft的壁纸~~~</p>', '2013-10-30 09:50:49'),
(23, 8, 8, '<p>MineCraft的桌面背景</p>', '2013-10-30 09:52:06');

-- --------------------------------------------------------

--
-- 表的结构 `downvote_answer`
--

CREATE TABLE IF NOT EXISTS `downvote_answer` (
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `downvote_answer`
--

INSERT INTO `downvote_answer` (`uid`, `aid`, `time`) VALUES
(9, 17, '2013-10-24 12:07:26');

-- --------------------------------------------------------

--
-- 表的结构 `downvote_question`
--

CREATE TABLE IF NOT EXISTS `downvote_question` (
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `qid` (`qid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `improvement`
--

CREATE TABLE IF NOT EXISTS `improvement` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iid`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `improvement`
--

INSERT INTO `improvement` (`iid`, `uid`, `aid`, `content`, `time`) VALUES
(1, 8, 16, '<p><span style="font-family: &#39;Trebuchet MS&#39;, 微软雅黑, arial; font-size: 12px;  background-color: rgb(255, 255, 255);">也可以用$.get(url,success)或$.ajax, 不过$.ajax就比较复杂了, 要用的话还是自己Google吧.</span></p>', '2013-10-24 11:56:59'),
(3, 8, 16, '<p>楼上正解</p>', '2013-10-24 11:57:03'),
(4, 8, 17, '<p>求详细...</p>', '2013-10-24 11:57:08'),
(5, 8, 17, '<p>$.get(url,function(){/*feedback code*/})</p><p>$.post(url,jsondata,function(){/*feedback code*/})</p>', '2013-10-24 11:57:12'),
(8, 8, 17, '<pre class="brush:js;toolbar:false">$.get(url,function(){/*feedback&nbsp;code*/})\n$.post(url,jsondata,function(){/*feedback&nbsp;code*/})</pre><p><br/></p>', '2013-10-24 11:57:17'),
(10, 9, 18, '<p>Java的话用matcher.group(i);</p>', '2013-10-24 11:57:22'),
(11, 8, 22, '<p>PS:非官方的</p>', '2013-10-30 10:16:12');

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`qid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `question`
--

INSERT INTO `question` (`qid`, `uid`, `title`, `content`, `time`, `tags`) VALUES
(3, 8, '怎么用jQuery实现Ajax?', '<p>RT:怎么用jQuery实现Ajax?</p>', '2013-10-24 11:54:11', '["jQuery","Ajax"]'),
(4, 9, '正则表达式匹配的组怎么引用?', '<p>如果对"15651768870"用</p><pre class="brush:php;toolbar:false">/(d{3})(d{4})(d{4})/</pre><p>要分别取156,5176,8870怎么取?</p>', '2013-10-24 11:54:29', '["正则表达式"]'),
(6, 8, 'Swing JFrame怎么除边框?', '<p>RT</p>', '2013-10-24 11:55:02', '["Swing","JFrame"]'),
(7, 9, 'Swing JFrame怎么除边框?', '<p>RT</p>', '2013-10-24 11:54:51', '["Swing","JFrame"]'),
(8, 8, '这张是什么图片?', '<p><img src="/ueditor/php/upload/20131030/1383126525822.jpg" title="a50f4bfbfbedab64c5c15668f736afc378311ee2.jpg"/></p>', '2013-10-30 09:49:17', '[]');

-- --------------------------------------------------------

--
-- 表的结构 `star`
--

CREATE TABLE IF NOT EXISTS `star` (
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `qid` (`qid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `star`
--

INSERT INTO `star` (`uid`, `qid`, `time`) VALUES
(8, 6, '2013-10-29 06:41:20');

-- --------------------------------------------------------

--
-- 表的结构 `upvote_answer`
--

CREATE TABLE IF NOT EXISTS `upvote_answer` (
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `upvote_answer`
--

INSERT INTO `upvote_answer` (`uid`, `aid`, `time`) VALUES
(9, 16, '2013-10-24 12:07:19'),
(8, 18, '2013-10-29 07:41:53'),
(10, 16, '2013-10-29 07:45:18'),
(10, 17, '2013-10-29 07:45:20'),
(10, 19, '2013-10-29 07:45:23'),
(10, 18, '2013-10-29 07:45:30'),
(10, 20, '2013-10-29 07:45:37'),
(10, 21, '2013-10-29 07:45:43');

-- --------------------------------------------------------

--
-- 表的结构 `upvote_question`
--

CREATE TABLE IF NOT EXISTS `upvote_question` (
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `qid` (`qid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `upvote_question`
--

INSERT INTO `upvote_question` (`uid`, `qid`, `time`) VALUES
(9, 3, '2013-10-24 12:07:11'),
(9, 6, '2013-10-24 12:07:57'),
(8, 4, '2013-10-29 07:41:50'),
(8, 7, '2013-10-29 07:42:04'),
(10, 3, '2013-10-29 07:45:17'),
(10, 4, '2013-10-29 07:45:29'),
(10, 6, '2013-10-29 07:45:35'),
(10, 7, '2013-10-29 07:45:42');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `password` varchar(25) CHARACTER SET utf8 NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `website` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `location` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `gender` int(1) NOT NULL,
  `avator` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `name`, `email`, `website`, `location`, `gender`, `avator`, `time`) VALUES
(8, 'linkeo', '141592653', '湮灭星空', 'linkeo@sohu.com', 'http://weibo.com/linkeo', '南京', 1, 25, '2013-10-24 11:53:34'),
(9, 'testuser', 'testuser', '我只是来测试的', 'testuser@test.com', NULL, NULL, 1, 0, '2013-10-24 11:53:46'),
(10, 'upvote', 'upvote', '专用粉丝', 'upvote@test.com', NULL, NULL, 2, 0, '2013-10-29 07:45:01');

-- --------------------------------------------------------

--
-- 表的结构 `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `vid` int(22) NOT NULL,
  `qid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `qid` (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 限制导出的表
--

--
-- 限制表 `accept`
--
ALTER TABLE `accept`
  ADD CONSTRAINT `accept_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE,
  ADD CONSTRAINT `accept_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `answer` (`aid`) ON DELETE CASCADE;

--
-- 限制表 `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `downvote_answer`
--
ALTER TABLE `downvote_answer`
  ADD CONSTRAINT `downvote_answer_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `answer` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `downvote_answer_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `downvote_question`
--
ALTER TABLE `downvote_question`
  ADD CONSTRAINT `downvote_question_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE,
  ADD CONSTRAINT `downvote_question_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `improvement`
--
ALTER TABLE `improvement`
  ADD CONSTRAINT `improvement_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `answer` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `improvement_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `star`
--
ALTER TABLE `star`
  ADD CONSTRAINT `star_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE,
  ADD CONSTRAINT `star_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `upvote_answer`
--
ALTER TABLE `upvote_answer`
  ADD CONSTRAINT `upvote_answer_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `answer` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `upvote_answer_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `upvote_question`
--
ALTER TABLE `upvote_question`
  ADD CONSTRAINT `upvote_question_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE,
  ADD CONSTRAINT `upvote_question_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
