<?php

include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();

$idReceiver=$_POST['destinataire'];
$subject=$_POST['sujet'];
$idSender=$bdd->getIdFromUsername($_SESSION['username']);
$date=date("d/m/Y");
$body=$_POST['message'];

$bdd->sendMessage($idSender,$idReceiver,$subject,$date,$body);
