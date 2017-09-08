<?php

error_reporting(0);

if (isset($_GET['which']))
{
    $which = $_GET['which'];
    switch ($which)
    {
    case 0:
    case 1:
    case 2:
        require_once $which.'.php';
         echo $flag;
        break;
    default:
        echo GWF_HTML::error('PHP-0817', 'Hacker NoNoNo!', false);
        break;
    }
}

?>