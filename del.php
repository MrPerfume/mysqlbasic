<?php
//************************删除记录**************************
//包含连接MySQL的文件
include "conn.php";
//获取地址栏传递过来的id值
$id = (int)$_GET["id"];
//构建要删除的SQL语句
$sql = "DELETE FROM 007_news WHERE id=$id";
//执行SQL语句
if(mysql_query($sql))
{
	//如果执行成功，则跳转到success.php页面
	$url = "manage.php";
	$message = urlencode("id={$id}记录删除成功！");
	echo "<script>location.href='success.php?url=$url&message=$message'</script>";
}else
{
	//如果执行失败，则跳转到error.php页面
	$message = urlencode("记录删除失败！");
	header("location:error.php?message=$message");
}
?>