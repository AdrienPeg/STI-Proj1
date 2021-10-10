<?php
include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

if(isset($_POST['disconnect']) && !empty($_POST['disconnect']))
{
    $bdd->unlogin();
    header("Location: http://localhost:8080/index.php?page=home");
    exit;
}

$username=$_POST['username'];
$password=$_POST['password'];
$res=$bdd->login($username,$password);
?>
<form name="redirect" method="post" action= "<?php echo'http://localhost:8080/index.php?page=home"'?>" enctype="multipart/form-data">
<input type="hidden" name="login_result" value="<?php echo $res ?>">
<script language="JavaScript">document.redirect.submit();</script></form>
