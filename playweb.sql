-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 01 日 16:59
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `playweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `pb_node`
--

CREATE TABLE IF NOT EXISTS `pb_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(60) COLLATE utf8_bin NOT NULL,
  `os` varchar(60) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `node_hash` varchar(15) COLLATE utf8_bin NOT NULL,
  `user_hash` varchar(15) COLLATE utf8_bin NOT NULL,
  `time` varchar(11) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pb_node`
--

INSERT INTO `pb_node` (`id`, `ip`, `os`, `status`, `node_hash`, `user_hash`, `time`) VALUES
(1, '127.0.0.1', 'Windows', 1, '70a1527626a1393', '68bc1fd5938fc77', '1396118456'),
(2, '58.217.200.13', 'Linux', 1, '68bc1fd5938fc99', '68bc1fd5938fc77', '1396112129');

-- --------------------------------------------------------

--
-- 表的结构 `pb_project`
--

CREATE TABLE IF NOT EXISTS `pb_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_hash` varchar(15) COLLATE utf8_bin NOT NULL,
  `target` varchar(255) COLLATE utf8_bin NOT NULL,
  `setting` text COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `pb_project`
--

INSERT INTO `pb_project` (`id`, `project_hash`, `target`, `setting`, `status`) VALUES
(19, '6a1411f02eff98a', 'w', 'a:11:{s:9:"web-ports";s:7:"80,8080";s:9:"app-ports";s:20:"21,22,1433,3389,3306";s:8:"file-ext";s:44:"cgi, cfm, asp, aspx, jsp, php, htm, html, do";s:8:"userlist";s:24:"admin,root,administrator";s:8:"passlist";s:17:"admin,root,123456";s:7:"dirlist";s:14:"admin,web,data";s:6:"client";s:99:"Referer:http://www.google.com User-Agent:Googlebot/2.1 (+http://www.googlebot.com/bot.html) Cookie:";s:6:"thread";s:2:"10";s:5:"depth";s:2:"10";s:6:"module";s:35:"port,crawler,sqli,xss,lfi,ftp-brute";s:10:"start_time";i:1398706203;}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pb_report`
--

CREATE TABLE IF NOT EXISTS `pb_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_hash` varchar(15) COLLATE utf8_bin NOT NULL,
  `type` varchar(250) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=125 ;

--
-- 转存表中的数据 `pb_report`
--

INSERT INTO `pb_report` (`id`, `project_hash`, `type`, `content`) VALUES
(120, '6a1411f02eff98a', 'sys_info', '{"language": "PHP/5.3.8", "port": 80, "service": "web", "server": "Apache/2.2.21 (Win64) PHP/5.3.8"}'),
(121, '6a1411f02eff98a', 'sys_info', '{"info": "N\\u0000\\u0000\\u0000\\n5.5.16-log\\u0000\\u0000\\u0000\\u0000pMlXT~=R\\u0000\\b\\u0002\\u0000\\u000f\\u0015\\u0000\\u0000\\u0000\\u0000\\u0000\\u0000\\u0000\\u0000\\u0000\\u0000g1[V!;H7z\\"95\\u0000mysql_native_password\\u0000", "port": 3306, "service": "mysql"}'),
(122, '6a1411f02eff98a', 'xss', '{"xss_type": "POST", "detail": "POST {''username'': u''admin<script>prompt(1)</script>'', ''email'': ''ya@xx.com'', ''password'': ''admin'', ''sub'': ''submit'', ''sex'': ''''} : URL ( scheme = http, netloc = w, path = /try/vul_lab/form.php, params = {}, query = )", "field": "username"}'),
(123, '6a1411f02eff98a', 'xss', '{"xss_type": "GET", "detail": "GET : URL ( scheme = http, netloc = w, path = /try/vul_lab/xss.php, params = {''a'': ''test'', ''b'': u''xxx<img src=1 onerror=prompt(1)>''}, query = a=test&b=xxx%3Cimg%20src%3D1%20onerror%3Dprompt%281%29%3E)", "param": "b"}'),
(124, '6a1411f02eff98a', 'sqli', '{"sqli_type": "MySQL Error Based", "detail": "GET : URL ( scheme = http, netloc = w, path = /try/vul_lab/sqli.php, params = {''x'': ''1'', ''id'': \\"1''\\"}, query = x=1&id=1%27)", "param": "id"}');

-- --------------------------------------------------------

--
-- 表的结构 `pb_user`
--

CREATE TABLE IF NOT EXISTS `pb_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `key` int(11) NOT NULL,
  `ip` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_hash` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pb_user`
--

INSERT INTO `pb_user` (`uid`, `name`, `email`, `password`, `key`, `ip`, `user_hash`) VALUES
(1, 'Yaseng', 'yaseng@uauc.net', '280cdd6f9854da616acb01', 1390034392, '', '68bc1fd5938fc77');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
