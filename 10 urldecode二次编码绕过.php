// 10 urldecode二次编码绕过 代码错误问题

<?php

$id = $_GET['id'];

if(preg_match("hackerDJ",$id)) {
  echo("<p>not allowed!</p>");
  $flag=false;
}
if ($flag === true) {
$m = urldecode($id);
if($m == "hackerDJ")
{
  echo "<p>Access granted!</p>";
  echo "<p>flag: *****************} </p>";
}
}
?>