<?php header("content-type:text/html;charset=utf-8"); //设置编码

if (!isset($_POST['submit'])) {
	exit("非法访问!");
}
$username = htmlspecialchars($_POST['username']);
$password = md5($_POST['password']);
//包含数据库连接文件
include('connect.php');
$sql = "
	select userid 
	from Users 
	where username='".$username."' and password='".$password."'
	limit 1
";

$check_query = mysql_query($sql);
if ($result = mysql_fetch_array($check_query)) {
	//登录成功
	$_SESSION['username']=$username;
	$_SESSION['userid']=$result["userid"];
	echo $username,',欢迎你！进入<a href="my.php">用户中心</a><br />';
	echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
	exit;
}
else{
	echo '登录失败!点击此处<a href ="javascript:history.back(-1)">返回</a>重试';
}
?>