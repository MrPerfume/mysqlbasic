<?php
//设置当前页面字符集为utf8
header("content-type:text/html;charset=utf8");
//包含相关文件
require("config.php");
require("functions.php");
//连接数据库
$link = getLink($db_host,$db_user,$db_pwd,$db_name);
?>