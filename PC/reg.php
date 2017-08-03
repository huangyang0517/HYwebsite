<?php header("content-type:text/html;charset=utf-8"); //设置编码

if (!isset($_POST['submit'])) {
	exit("非法访问");
}
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
//注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 6){
    exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email)){
	echo "email:"+'".$email."'+"<br>";
    exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
}

//包含数据库连接文件
include('connect.php');

$check_query = mysql_query("select * from Users where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
    echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
    exit;
}

//写入数据
$password = MD5($password);
$regdate = time();
$sql = "INSERT INTO Users(username,password,email)VALUES('$username','$password','$email')";
if(mysql_query($sql,$conn)){
    exit('用户注册成功！点击此处 <a href="login.html">登录</a>');
} else {
    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}

?>