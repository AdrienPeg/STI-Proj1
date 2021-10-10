<?php

include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

$idReceiver=$_POST['destinataire'];
$subject=$_POST['sujet'];
$idSender=$_SESSION['id'];
$date=date("d/m/Y H:i");
$body=$_POST['message'];

$bdd->sendMessage($idSender,$idReceiver,$subject,$date,$body);

header("Location: http://localhost:8080/index.php?page=home");
