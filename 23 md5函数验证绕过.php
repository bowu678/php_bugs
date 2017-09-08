<?php

error_reporting(0);
$flag = 'flag{test}';
$temp = $_GET['password'];
if(md5($temp)==0){
    echo $flag;
}

?>