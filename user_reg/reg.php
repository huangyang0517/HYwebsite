<?php
if(!isset($_POST['submit'])){
	exit('·Ç·¨·ÃÎÊ!');
}
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
//×¢²áÐÅÏ¢ÅÐ¶Ï
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('´íÎó£ºÓÃ»§Ãû²»·ûºÏ¹æ¶¨¡£<a href="javascript:history.back(-1);">·µ»Ø</a>');
}
if(strlen($password) < 6){
	exit('´íÎó£ºÃÜÂë³¤¶È²»·ûºÏ¹æ¶¨¡£<a href="javascript:history.back(-1);">·µ»Ø</a>');
}
if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email)){
	exit('´íÎó£ºµç×ÓÓÊÏä¸ñÊ½´íÎó¡£<a href="javascript:history.back(-1);">·µ»Ø</a>');
}
//°üº¬Êý¾Ý¿âÁ¬½ÓÎÄ¼þ
include('conn.php');
//¼ì²âÓÃ»§ÃûÊÇ·ñÒÑ¾­´æÔÚ
$check_query = mysql_query("select uid from Users where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
	echo '´íÎó£ºÓÃ»§Ãû ',$username,' ÒÑ´æÔÚ¡£<a href="javascript:history.back(-1);">·µ»Ø</a>';
	exit;
}
//Ð´ÈëÊý¾Ý
$password = MD5($password);
$regdate = time();
$sql = "INSERT INTO Users(username,password,email,regdate)VALUES('$username','$password','$email',$regdate)";
if(mysql_query($sql,$conn)){
	exit('ÓÃ»§×¢²á³É¹¦£¡µã»÷´Ë´¦ <a href="login.html">µÇÂ¼</a>');
} else {
	echo '±§Ç¸£¡Ìí¼ÓÊý¾ÝÊ§°Ü£º',mysql_error(),'<br />';
	echo 'µã»÷´Ë´¦ <a href="javascript:history.back(-1);">·µ»Ø</a> ÖØÊÔ';
}
?>
