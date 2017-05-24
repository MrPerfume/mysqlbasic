<?php
//***************************用户登录检查**************************
//连接MySQL数据库
include "conn.php";
//判断表单是否提交
if(isset($_POST["ac"]) && $_POST["ac"]=="login")
{
	//获取表单提交数据
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	//构建要查询的SQL语句
	$sql = "SELECT * FROM 007_admin WHERE username='$username' and password='$password'";
	//执行SQL语句
	$result = mysql_query($sql);
	//获取结果集中的记录条数
	$records = mysql_num_rows($result);
	//判断是否找到匹配
	if($records)
	{
		//如果找到匹配
		//获取相关变量信息
		$lastloginip = $_SERVER["REMOTE_ADDR"];
		$lastlogintime = time();
		//构建更新的SQL语句
		$sql = "UPDATE 007_admin SET lastloginip='$lastloginip',lastlogintime=$lastlogintime,loginhits=loginhits+1 WHERE username='$username'";
		//执行SQL语句
		mysql_query($sql);
		//跳转到成功页面
		$url = "manage.php";
		$message = urlencode("用户登录成功！");
		header("location:success.php?url=$url&message=$message");
	}else
	{
		//如果没有找到匹配
		$message = urlencode("用户名或密码不正确！");
		header("location:error.php?message=$message");
	}
}else
{
	//如果非法操作
	$message = urlencode("非法操作");
	header("location:error.php?message=$message");
}
?>

