<!DOCTYPE html>
<html>
<head>
<title>Web 350</title>
<style type="text/css">
        body {
                background:gray;
                text-align:center;
        }
</style>
</head>

<body>
        <?php
                $auth = false;
                $role = "guest";
                $salt =
                if (isset($_COOKIE["role"])) {
                        $role = unserialize($_COOKIE["role"]);
                        $hsh = $_COOKIE["hsh"];
                        if ($role==="admin" && $hsh === md5($salt.strrev($_COOKIE["role"])))
// strrev返回 string 反转后的字符串。 
                         {
                                $auth = true;
                        } else {
                                $auth = false;
                        }
                } else {
                        $s = serialize($role);
                        setcookie('role',$s);
                        $hsh = md5($salt.strrev($s));
                        setcookie('hsh',$hsh);
                }
                if ($auth) {
                        echo "<h3>Welcome Admin. Your flag is 
                } else {
                        echo "<h3>Only Admin can see the flag!!</h3>";
                }
        ?>
        
</body>
