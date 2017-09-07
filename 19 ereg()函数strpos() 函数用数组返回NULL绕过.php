<?php  

$flag = "flag";  
   
if (isset ($_GET['password'])) {  
    if (ereg ("^[a-zA-Z0-9]+$", $_GET['password']) === FALSE)  
        echo 'You password must be alphanumeric';  
    else if (strpos ($_GET['password'], '--') !== FALSE)  
        die('Flag: ' . $flag);  
    else  
        echo 'Invalid password';  
}  
?>