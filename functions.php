<?php
/*******************************连接数据库函数****************************************/
function getLink($db_host,$db_user,$db_pwd,$db_name)
{
	//连接MySQL数据库
	$link = mysql_connect($db_host,$db_user,$db_pwd);
	if(!$link)
	{
		echo "<li>连接MySQL出错了，请检查数据库配置信息！</li>";
		exit();
	}
	//选择当前数据库
	if(!mysql_select_db($db_name))
	{
		echo "<li>选择MySQL出错了，请检查数据库配置信息！</li>";
		exit();
	}
	//设置当前字符集
	mysql_query("set names utf8");
	//如果数据库连接成功，返回连接标识
	return $link;
}








?>