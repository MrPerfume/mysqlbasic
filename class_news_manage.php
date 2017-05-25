<?php
require_once("include/conn.php");
//**************************************************************************************************
$sql="select * from {$db_prefix}class_news";
$result = mysql_query($sql);
$records = mysql_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>̨新闻类别管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/public.css' rel='stylesheet' type='text/css'>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="topbg"><td>新闻类别管理</td></tr>
	<tr class="tdbg">
		<td height="30">&nbsp;&nbsp;<a href='class_news_manage.php'>新闻类别管理首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='class_news_add.php'>添加新闻类别</a></td>
	</tr>
</table>
<br/>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="border">
<tr class="title" align="center">
	<td>编号</td>
	<td>类别名称</td>
	<td>类别排序</td>
	<td>操作选项</td>
</tr>
<?php
//判断栏目是否为空
if($records==0)
{
	echo "<tr class='tdbg' align=center><td colspan=4>本频道没有任何内容</td></tr>";
}else
{
	while($row=mysql_fetch_array($result))
	{
		echo "<tr class='tdbg' $onmouseover align='center'>";
		echo "<td>".$row["id"]."</td>";
		echo "<td>".$row["classname"]."</td>";
		echo "<td>".$row["orderby"]."</td>";
		echo "<td><a href=class_news_edit.php?id=".$row["id"].">修改</a> | <a href='#' onClick=\"ConfirmDel(".$row["id"].")\">删除</a></td>";
		echo "</tr>";
	}
}
?>
</table>
<script language="javascript">
function ConfirmDel(id)
{
	if(window.confirm("确定要删除吗？"))
	{
		location.href="class_news_del.php?id="+id
	}else
	{
		return false;
	}
}
</script>
</body>
</html>