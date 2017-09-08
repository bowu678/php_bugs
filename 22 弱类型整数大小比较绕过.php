<?php

error_reporting(0);
$flag = "flag{test}";

$temp = $_GET['password'];
is_numeric($temp)?die("no numeric"):NULL;    
if($temp>1336){
    echo $flag;
} 

?>