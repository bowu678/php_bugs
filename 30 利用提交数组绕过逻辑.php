<?php 
$role = "guest";
$flag = "flag{test_flag}";
$auth = false;
if(isset($_COOKIE["role"])){
    $role = unserialize(base64_decode($_COOKIE["role"]));
    if($role === "admin"){
        $auth = true;
    }
    else{
        $auth = false;
    }
}
else{
    $role = base64_encode(serialize($role));
    setcookie('role',$role);
}
if($auth){
    if(isset($_POST['filename'])){
        $filename = $_POST['filename'];
        $data = $_POST['data'];
        if(preg_match('[<>?]', $data)) {
            die('No No No!'.$data);
        }
        else {
            $s = implode($data);
            if(!preg_match('[<>?]', $s)){
                $flag='None.';
            }
            $rand = rand(1,10000000);
            $tmp="./uploads/".md5(time() + $rand).$filename;
            file_put_contents($tmp, $flag);
            echo "your file is in " . $tmp;
        }
    }
    else{
        echo "Hello admin, now you can upload something you are easy to forget.";
        echo "<br />there are the source.<br />";
        echo '<textarea rows="10" cols="100">';
        echo htmlspecialchars(str_replace($flag,'flag{???}',file_get_contents(__FILE__)));
        echo '</textarea>';
    }
}
else{
    echo "Sorry. You have no permissions.";
}
?>
