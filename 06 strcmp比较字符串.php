<?php
$flag = "flag";
if (isset($_GET['a'])) {  
    if (strcmp($_GET['a'], $flag) == 0) //如果 str1 小于 str2 返回 < 0； 如果 str1大于 str2返回 > 0；如果两者相等，返回 0。 

    //比较两个字符串（区分大小写） 
        die('Flag: '.$flag);  
    else  
        print 'No';  
}

?>