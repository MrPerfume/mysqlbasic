<?php
require_once("include/conn.php");
//*****************************************************************************************
if(isset($_POST["ac"]) && $_POST["ac"]=="add")
{
	$cat = intval($_POST["cat"]);
	$title=trim($_POST["title"]);//标题
	$author=trim($_POST["author"]);//作者
	$source=trim($_POST["source"]);//来源
	$orderby=intval($_POST["orderby"]);//排序
	$keywords=trim($_POST["keywords"]);
	$description=trim($_POST["description"]);
	$content=addslashes($_POST["content"]);//内容
	$addate=time();

	//向数据库添加一条文章
	$sql="insert into {$db_prefix}news(cat,title,author,source,keywords,description,content,addate,orderby) values($cat,'$title','$author','$source','$keywords','$description','$content',$addate,$orderby)";
	if(mysql_query($sql))
	{
		$message=urlencode("添加成功！");
		$url="news_manage.php";
		echo "<script>location.href='success.php?message=$message&url=$url'</script>";
		exit();
	}else
	{
		$message=urlencode("添加失败！");
		echo "<script>location.href='error.php?&message=$message'</script>";
		exit();
	}
}else
{
	$sql = "select * from {$db_prefix}site where id=1";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='css/public.css' rel='stylesheet' type='text/css'>
<script charset="utf-8" src="js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="js/editor/lang/zh_CN.js"></script>
<script>
//加入在线编辑器
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="content"]', {
		allowFileManager : true
	});
});
</script>
<script language="javascript">
function checkForm()
{
	if(document.form1.title.value.length==0)
	{
		alert("标题不能为空");
		document.form1.title.focus();
		return false;
	}else if(document.form1.author.value.length==0)
	{
		alert("作者不能为空");
		document.form1.author.focus();
		return false;
	}else if(document.form1.source.value.length==0)
	{
		alert("来源不能为空");
		document.form1.source.focus();
		return false;
	}else
	{
		return true;
	}
}
</script>
<title>新闻管理</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="border">
	<tr class="topbg">
	  <td>新闻管理</td>
	</tr>
	<tr class="tdbg">
		<td height="30">&nbsp;&nbsp;<a href='news_manage.php'>新闻管理首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='news_add.php'>添加新闻</a></td>
	</tr>
</table>
<br/>
<form action="" method="post" name="form1" id="form1" onsubmit="return checkForm()">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="border">
	<tr class="title">
		<td colspan="6" align="center">添加新闻内容</td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td width="12%" align="right" bgcolor="#f5f5f5">新闻分类：</td>
		<td colspan="5">
		<select name="cat">
			<?php
			$sql2 = "select * from {$db_prefix}class_news";
			$result2 = mysql_query($sql2);
			while($row2=mysql_fetch_assoc($result2))
			{
				echo "<option value='".$row2["id"]."'>".$row2["classname"]."</option>";
			}
			?>
		</select>
		</td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td width="12%" align="right" bgcolor="#f5f5f5">标&nbsp;&nbsp;&nbsp;&nbsp;题：</td>
		<td colspan="5"><input name="title" type="text" id="title" style="width:500px;" />
	    <font color=red>*</font></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
	  <td align="right" bgcolor="#f5f5f5">作&nbsp;&nbsp;&nbsp;&nbsp;者：</td>
	  <td width="22%"><input name="author" type="text" id="author" value="admin" size="15" />
      <font color=red>*</font></td>
      <td width="6%" align="right">来源：</td>
      <td width="20%"><input name="source" type="text" id="source" value="<?php echo $row["source"]?>" size="15" />
      <font color="red">*</font></td>
	  <td width="6%" align="right">排序：</td>
	  <td width="36%"><input name="orderby" type="text" id="orderby" value="50" size="5" /></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
	  <td align="right" bgcolor="#f5f5f5">关键词：</td>
	  <td colspan="5"><input name="keywords" style="width:500px;" type="text" id="keywords" size="50" maxlength="100" /></td>
    </tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
	  <td align="right" bgcolor="#f5f5f5">网页描述：</td>
	  <td colspan="5"><textarea name="description" style="width:100%;height:60px;" id="description"></textarea></td>
    </tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td align="right" bgcolor="#f5f5f5">内&nbsp;&nbsp;&nbsp;&nbsp;容：</td>
		<td colspan="5">
		<textarea id="content" name="content" style="width:100%;height:300px;visibility:hidden;"></textarea></td>
	</tr>
	<tr class="tdbg" <?php echo $onmouseover?>>
		<td align="center" colspan="6">
			<input type="submit" name="submit" value="添加" />&nbsp;
			<input type="hidden" name="ac" value="add" />
			<input type="button" onclick="javascript:history.go(-1)" value="返回" />		</td>
	</tr>
</table>
</form>
</body>
</html>
