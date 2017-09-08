<?php 
error_reporting(0);
$link = mysql_connect('localhost', 'root', 'root');
if (!$link) { 
  die('Could not connect to MySQL: ' . mysql_error()); 
} 
// 选择数据库
$db = mysql_select_db("security", $link);
if(!$db)
{
  echo 'select db error';
  exit();
}
// 执行sql
$password = $_GET['password'];
$sql = "SELECT * FROM users WHERE password = '".md5($password,true)."'";
var_dump($sql);
$result=mysql_query($sql) or die('<pre>' . mysql_error() . '</pre>' );
$row1 = mysql_fetch_row($result);
var_dump($row1);
mysql_close($link);
?>