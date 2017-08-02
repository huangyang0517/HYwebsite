<?php

$conn = @mysql_connect("localhost:8889","root","root");
if (!$conn){
	die("连接失败:" . mysql_error());
}
echo "连接成功";
mysql_select_db("donghuangstudio", $conn);

mysql_query("set character set 'gbk'");
//Ð´¿â
mysql_query("set names 'gbk'");
?>