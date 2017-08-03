<?php

$conn = @mysql_connect("localhost:8889","root","root");
if (!$conn){
	die("连接失败:" . mysql_error());
}
mysql_select_db("donghuangstudio", $conn);

// mysql_query("set character set 'gbk'");

// mysql_query("set names 'gbk'");
mysql_query("set character set 'utf8'");

mysql_query("set names 'utf8'");

?>