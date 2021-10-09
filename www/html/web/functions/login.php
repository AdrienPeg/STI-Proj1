<?php
include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

if(isset($_POST['disconnect']) && !empty($_POST['disconnect']))
{
    echo 'Lets go';
    $bdd->unlogin();
    echo 'done';
    header("Location: http://localhost:8080/index.php?page=home");
    exit;
}

$username=$_POST['username'];
$password=$_POST['password'];
$res=$bdd->login($username,$password);
if($res)
{
    header("Location: http://localhost:8080/index.php?page=messages");
    exit;
}
else
{
    header("Location: http://localhost:8080/index.php?page=home");
    exit;
}