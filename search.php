<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
 <！--先写一个自适应代码，手机电脑兼容-->
<title><?php echo $_GET['search']; ?> - 千度搜索</title>
<！--标题随着用户输入的关键词的变化而变化-->
<?php
header("Content-Type:text/html;charset=gb2312");
//先确定该页面的编码为gb2312





//-----------下面这一行要设置你的数据库信息
$con = mysql_connect("数据库地址","数据库用户名","数据库密码");
//当然，你并不需要担心密码泄露，因为前端代码不会显示密码
if (!$con)
  {
  die('数据库出错，错误原因：' . mysql_error());
  //万一数据库出错，它还能告诉你怎么回事
  }
mysql_query("set names 'gb2312'",$con);
//这里填写的是php与数据库传输数据的编码，就像发电报时的电报编码表，不用管它





//-----------下面这一行要设置你的数据库信息
mysql_select_db("你的数据库名称", $con);
//确定sql命令执行的表
//好了，MySQL那边设定好了，轮到php传输过程了
  $searchs = $_GET['search'];  //传递搜索框过来的值
$searchs= trim($searchs);
//除去字符串两端空格
if (!$searchs){
echo '输入为空';
exit;
}
//这个设定了当用户没有输入或输入空格时的事件

$result = mysql_query("SELECT * FROM search where keyword like '%$searchs%' AND enter LIKE '%".$enter."%'");
//开始搜索并获取结果
echo "网页搜索结果<hr>";
//开始输出标题
if (mysql_num_rows($result) < 1) echo "无结果，去<a href='//baidu.com/s?word=".$searchs."'>百度</a>看看";
//当结果数量为0时的事件
//以下开始输出结果
while($row = mysql_fetch_array($result))
 {
  echo "<a href=".$row['enter'].">".$row['name']."</a>" ;
  echo "<br />";
  echo $row['text'] ;
  echo "<hr />";
  }
  //与数据库断开连接
mysql_close($con);
//程序结束
?>
