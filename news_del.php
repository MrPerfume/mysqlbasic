<?php
require_once("include/conn.php");
//判断id是否存在
if(isset($_GET["id"]))
{
	$id=intval($_GET["id"]);
	//删除新闻记录
	$sql="delete from {$db_prefix}news where id=$id";
	if(mysql_query($sql))
	{
		$message=urlencode("删除成功！");
		$url="news_manage.php";
		echo "<script>location.href='success.php?message=$message&url=$url'</script>";
		exit();
	}else
	{
		$message=urlencode("删除失败！");
		echo "<script>location.href='error.php?message=$message'</script>";
		exit();
	}
}
?>