<?php
require_once("include/conn.php");
//*************************************************************************************************************
if(isset($_POST["ac"]) && $_POST["ac"]=="add")
{
	//取得表单提交值
	$classname=trim($_POST["classname"]);
	$orderby=trim($_POST["orderby"]);
	
	//判断是否存在同名栏目
	$sql="select * from {$db_prefix}class_news where classname='$classname'";
	$result = mysql_query($sql);
	$records = mysql_num_rows($result);
	if($records ==1)
	{
		$message=urlencode("类别名称 $classname 已经存在！");
		$url="class_news_manage.php";
		echo "<script>location.href='success.php?message=$message&url=$url'</script>";
		exit();
	}
	//写入数据到数据库
	$sql="insert into {$db_prefix}class_news(classname,orderby) values('$classname',$orderby)";
	if(mysql_query($sql))
	{
		$message=urlencode("添加成功！");
		$url="class_news_manage.php";
		echo "<script>location.href='success.php?message=$message&url=$url'</script>";
		exit();
	}else
	{
		$message=urlencode("添加失败！");
		echo "<script>location.href='error.php?message=$message'</script>";
		exit();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/public.css' rel='stylesheet' type='text/css'>
<script language="javascript">
function checkForm()
{
	if(document.form1.classname.value=="")
	{
		alert("类别名称不能为空");
		document.form1.classname.focus();
		return false;
	}else
	{
		return true;
	}
}
</script>

<title>新闻类别管理</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="topbg">
	  <td>新闻类别管理</td>
	</tr>
	<tr class="tdbg">
		<td height="30">&nbsp;&nbsp;<a href='class_news_manage.php'>新闻类别管理首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='class_news_add.php'>添加新闻类别</a></td>
	</tr>
</table>
<br/>
<form name="form1" method="post" action="" onsubmit="return checkForm();">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="title">
		<td colspan="2" align="center">添加新闻类别</td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
	  <td align="right"><strong>类别名称：</strong></td>
	  <td width="59%"><input name="classname" type="text" id="classname" /></td>
    </tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td width="41%" align="right"><b>类别排序：</b></td>
		<td><input name="orderby" type="text" id="orderby" value="50" size="5" /></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td align="center" colspan="2">
			<input type="submit" name="submit" value="添加" />&nbsp;
			<input type="hidden" name="ac" value="add" />
			<input type="button" onclick="javascript:history.go(-1);" value="返回" />		</td>
	</tr>
</table>
</form>
</body>
</html>
