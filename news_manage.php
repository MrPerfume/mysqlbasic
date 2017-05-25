<?php
require_once("include/conn.php");
//**************************************新闻分页显示*************************************************
$pagesize = 20;//每页显示20条记录
//获取当前页面，并计算每页开始行号
if(empty($_GET["page"]))
{
	$page = 1;
	$startrow = 0;
}else
{
	$page = intval($_GET["page"]);
	$startrow = ($page-1)*$pagesize;
}
//总记录数和总页数
$sql="select * from {$db_prefix}news";
$result = mysql_query($sql);
$records = mysql_num_rows($result);
$pages = ceil($records/$pagesize);

//分页SQL语句
$sql .= " order by orderby asc,id desc limit $startrow,$pagesize";
$result=mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>̨新闻管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/public.css' rel='stylesheet' type='text/css'>
<style type="text/css">
a.a10:link,a.a10:visited{
	font-weight:bold;
	padding:3px;
}
a.a9:link,a.a9:visited{
	font-weight:bold;
	padding:3px;
}
.txt1{border:1px solid #cccccc;padding:2px;color:#444;}
.btn1{border:1px solid #b9b9b9;padding:2px;background:#e9e9e9;padding-top:2px;}
</style>

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="topbg"><td>新闻管理</td></tr>
	<tr class="tdbg">
		<td height="30">&nbsp;&nbsp;<a href='news_manage.php'>新闻管理首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='news_add.php'>添加新闻</a></td>
	</tr>
</table>
<form style="margin:0px;padding:0px;margin:5px;" name="form1" method="post" action="">
<table border="0" align="center" cellpadding="0" cellspacing="1">
	<tr class="tdbg">
	  <td><input type="text" class="txt1" size="30" name="key" /></td>
	  <td>&nbsp;</td>
		<td>
	  	<input class="btn1" type="submit" name="submit" value="搜索">
		<input type="hidden" name="ac" value="search" />
	 </td>
	</tr>
</table>
</form>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="border">
<tr class="title" align="center">
	<td>编号</td>
	<td>标题</td>
	<td>作者</td>
	<td>点击</td>
	<td>发布日期</td>
	<td>排序</td>
	<td>操作选项</td>
</tr>
<?php
//判断栏目是否为空
if($records==0)
{
	echo "<tr class='tdbg' align=center><td colspan=7>本频道没有任何信息</td></tr>";
}else
{
	while($row=mysql_fetch_assoc($result))
	{
		//循环输出表格
		echo "<tr class='tdbg' align='center' $onmouseover>";
		echo "<td>".$row["id"]."</td>";
		echo "<td align='left'><a target='_blank' href='/newsdetail.php?id=".$row["id"]."'>".$row["title"]."</a></td>";
		echo "<td>".$row["author"]."</td>";
		echo "<td>".$row["hits"]."</td>";
		echo "<td>".date("Y-m-d",$row["addate"])."</td>";
		echo "<td>".$row["orderby"]."</td>";
		echo "<td><a href='news_edit.php?id=".$row["id"]."'>修改</a> | <a href='#' onClick='ConfirmDel(".$row["id"].")'>删除</a></td>";
		echo "</tr>";
	}
	//输出分页信息
	echo "<tr class='tdbg pagelist' align='center' $onmouseover><td colspan='7'>";
	echo "<ul><li>共 $records 条记录</li>";
	if($page>1)
	{
		echo "<li><a href='news_manage.php?page=".($page-1)."'>上一页</a></li>";
	}
	for($i=1;$i<=$pages;$i++)
	{
		if($i==$page)
		{
			echo "<li class='current'>$i</li>";
		}else
		{
			echo "<li><a href='news_manage.php?page=$i'>$i</a></li>";
		}
	}
	if($page<$pages)
	{
		echo "<li><a href='news_manage.php?page=".($page+1)."'>下一页</a></li>";
	}
	echo "<li>第 $page 页/共 $pages 页</li>";
	echo "</ul></td></tr>";
}
?>
</table>
<script language="javascript">
function ConfirmDel(id)
{
	if(confirm("确定要删除此记录吗？"))
	{
		location.href="news_del.php?id="+id;
	}else
	{
		return false;
	}
}
</script>
</body>
</html>
