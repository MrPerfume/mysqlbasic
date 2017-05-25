<?php
require_once("include/conn.php");
//***********************删除一条记录************************************
if(isset($_GET["id"]))
{
	$id=intval($_GET["id"]);
	$sql="delete from {$db_prefix}class_news where id=$id";
	if(mysql_query($sql))
	{
		$message=urlencode("删除成功！");
		$url="class_news_manage.php";
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