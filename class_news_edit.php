<?php
require_once("include/conn.php");
//******************************************************************************************************
if(isset($_POST["ac"]) && $_POST["ac"]=="edit")
{
	//获取表单提交值
	$id=trim($_POST["id"]);
	$classname=trim($_POST["classname"]);
	$orderby=trim($_POST["orderby"]);
	//更新数据
	$sql="update {$db_prefix}class_news set classname='$classname',orderby=$orderby where id=$id";
	if(mysql_query($sql))
	{
		$message=urlencode("修改成功！");
		$url="class_news_manage.php";
		echo "<script>location.href='success.php?message=$message&url=$url'</script>";
		exit();
	}else
	{
		$message=urlencode("修改失败！");
		echo "<script>location.href='error.php?message=$message'</script>";
		exit();
	}
}else
{
	$id=intval(trim($_GET["id"]));
	$sql="select * from {$db_prefix}class_news where id=$id";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
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
		document.form1.name.focus();
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
	<tr class="topbg"><td>新闻类别管理</td></tr>
	<tr class="tdbg">
		<td height="30">&nbsp;&nbsp;<a href='class_news_manage.php'>新闻类别管理首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='class_news_add.php'>添加新闻类别</a></td>
	</tr>
</table>
<br/>
<form name="form1" method="post" action="" onsubmit="return checkForm();">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="title">
		<td colspan="2" align="center">修改新闻类别</td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover;?>>
		<td align="right"><b>类别名称：</b></td>
		<td width="57%"><input name="classname" type="text" id="classname" value="<?php echo $row["classname"]?>" /></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td width="43%" align="right"><b>类别排序：</b></td>
		<td><input name="orderby" type="text" id="orderby" value="<?php echo $row["orderby"]?>" size="5" /></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td align="center" colspan="2">
			<input type="submit" name="submit" value="更新" />&nbsp;
			<input type="hidden" name="ac" value="edit" />
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="button" onClick="javascript:history.go(-1);"  value="返回" />		</td>
	</tr>
</table>
</form>
</body>
</html>
