<?php

include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

$id=$_POST['id'];
$password=$_POST['password'];
$valid=$_POST['valid'];
$type=$_POST['type'];
$res=$bdd->editUser($id, $password, $valid, $type);
?>

<form name="redirect" method="post" action= "<?php echo'http://localhost:8080/index.php?page=userEdit"'?>" enctype="multipart/form-data">
    <input type="hidden" name="editResult" value="<?php echo $res ?>">
    <input type="hidden" name="editUserTab" value="<?php echo $id ?>">
    <script language="JavaScript">document.redirect.submit();</script></form>