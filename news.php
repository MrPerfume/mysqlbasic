<?php
require("admin/include/conn.php");
//获取当前传递的新闻类别
if(empty($_GET["cat"]))
{
	$typename = "全部新闻";
}else
{
	$cat = intval($_GET["cat"]);
	$sql = "select * from {$db_prefix}class_news where id=$cat";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$typename = $row["classname"];
}
//获取当前页码
$pagesize = 20;
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
$sql = "select * from {$db_prefix}news";
if(isset($_GET["cat"]))
{
	$sql .= " where cat=$cat";
}

$result = mysql_query($sql);
$records = mysql_num_rows($result);
$pages = ceil($records/$pagesize);
$sql .= " order by orderby asc,id desc limit $startrow,$pagesize";
$result = mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/public.css" type="text/css" rel="stylesheet" />
<link href="css/news.css" type="text/css" rel="stylesheet" />
<title>新闻资讯_{$SiteList.webname}</title>
</head>

<body>
<div class="box">
<?php require("header.php");?>
<div class="main">
<!--left-->
<div class="left floatL">
	<!--aboutus-->
	<div class="news">
		<div class="title">新闻中心</div>
		<div class="content">
			<ul>
				<?php
				$sql2 = "select * from {$db_prefix}class_news";
				$result2 = mysql_query($sql2);
				$n=0;
				while($row2=mysql_fetch_assoc($result2)){
					$n++;
				?>
				<li<?php if($n==1){echo " id='noTopLine'";}?>><a href="news.php?cat=<?php echo $row2["id"]?>"><?php echo $row2["classname"]?></a></li>
				<?php }?>
			</ul>
		</div>
	</div><!--//aboutus-->
	<!--联系我们-->
	<div class="contact">
		<div class="title">联系我们</div>
		<div class="content">
			<img src="images/tel02.png" />
			<p>电话：0371-12345678<br />
				传真：0371-12345678<br />
				邮箱：saixinjituan@126.com<br />
				地址：河南开封市东开发区黄龙园区园区路1号
			</p>
		</div>
	</div><!--//联系我们-->
</div><!--//left-->
<!--right-->
<div class="right floatR">
	<div class="title">当前位置：<a href="/">网站首页</a> >&nbsp;<a href="#">新闻中心</a> >&nbsp;<?php echo $typename?></div>
	<div class="content">
		<ul>
			<?php
			while($row=mysql_fetch_assoc($result)){
			?>
			<li><a href="newsdetail.php?id=<?php echo $row["id"]?>" target="_blank"><?php echo $row["title"]?></a><span><?php echo date("Y-m-d H:i:s",$row["addate"]);?></span></li>
			<?php }?>
		</ul>
	</div>
	<div class="blank"></div>
	<div class="pagelist">
	<?php
	echo "共 $records 条记录";
	if($page>1)
	{
		echo "&nbsp;&nbsp;<a href='news.php?page=".($page-1)."'>上一页</a>";
	}
	//循环遍历所有分页
	$pre = $page-3;
	if($pre<1){$pre=1;}
	$next = $page+3;
	if($next>$pages){$next=$pages;}
	for($i=$pre;$i<=$next;$i++)
	{
		if($page==$i)
		{
			echo "<span>$i</span>";
		}else
		{
			echo "<a href='news.php?page=$i'>$i</a>";
		}
	}
	if($page<$pages)
	{
		echo "<a href='news.php?page=".($page+1)."'>下一页</a>&nbsp;&nbsp;";
	}
	echo "第 $page 页/共 $pages 页";
	?>
	</div>
</div><!--//right-->
<div class="clear"></div>
</div><!--//main-->
</div><!--//box-->
<?php include("footer.php");?>
</body>
</html>
