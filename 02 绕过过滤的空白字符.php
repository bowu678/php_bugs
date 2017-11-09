<?php
 
$info = ""; 
$req = [];
$flag="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
 
ini_set("display_error", false); //为一个配置选项设置值
error_reporting(0); //关闭所有PHP错误报告
 
if(!isset($_GET['number'])){
   header("hint:26966dc52e85af40f59b4fe73d8c323a.txt"); //HTTP头显示hint 26966dc52e85af40f59b4fe73d8c323a.txt
 
   die("have a fun!!"); //die — 等同于 exit()
 
}
 
foreach([$_GET, $_POST] as $global_var) {  //foreach 语法结构提供了遍历数组的简单方式 
    foreach($global_var as $key => $value) { 
        $value = trim($value);  //trim — 去除字符串首尾处的空白字符（或者其他字符）
        is_string($value) && $req[$key] = addslashes($value); // is_string — 检测变量是否是字符串，addslashes — 使用反斜线引用字符串
    } 
} 
 
 
function is_palindrome_number($number) { 
    $number = strval($number); //strval — 获取变量的字符串值
    $i = 0; 
    $j = strlen($number) - 1; //strlen — 获取字符串长度
    while($i < $j) { 
        if($number[$i] !== $number[$j]) { 
            return false; 
        } 
        $i++; 
        $j--; 
    } 
    return true; 
} 
 
 
if(is_numeric($_REQUEST['number'])) //is_numeric — 检测变量是否为数字或数字字符串 
{
 
   $info="sorry, you cann't input a number!";
 
}
elseif($req['number']!=strval(intval($req['number']))) //intval — 获取变量的整数值
{
 
     $info = "number must be equal to it's integer!! ";  
 
}
else
{
 
     $value1 = intval($req["number"]);
     $value2 = intval(strrev($req["number"]));  
 
     if($value1!=$value2){
          $info="no, this is not a palindrome number!";
     }
     else
     {
 
          if(is_palindrome_number($req["number"])){
              $info = "nice! {$value1} is a palindrome number!"; 
          }
          else
          {
             $info=$flag;
          }
     }
 
}
 
echo $info;