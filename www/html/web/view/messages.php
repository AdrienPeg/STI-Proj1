<?php
#################################################################
#
#	Projet STI
#	Auteurs:		Adrien Peguiron, Nicolas Viotti
#
#################################################################
#
# 	Date :		01.10.2021
#	Version :		1.0
#	Révisions :		-
#
#################################################################
#
#	Page: messages.php (Affichage des messages de l'user)
#
################################################################

#session_start();

?>
<!DOCTYPE html>
<html>

<?php


include_once ("/usr/share/nginx/html/web/functions/database.php");
$bdd = new database();
?>

<div class ="container" id="DeleteEdit">
    <!--Affichage des articles -->
    <div id="affichage-articles">
        <h1 style="text-decoration: underline;"> Messages </h1>
        <h4>

            <?php

            //if(!isset($_POST['userid'])){ echo $_POST['userid'];} else { header("Location: http://localhost/WatchOut/?page=index.php");} //Redirection si pas connecté

            $userid = $_POST['userid'];
            //Sélection des données shouaitées dans la BD
            //$queryaffMessage=$bdd->prepare("SELECT * FROM Messages WHERE id_recepteur='".$userid."' ORDER BY date DESC");   //l'entrée 1 de la table genre correspond à homme
            /*$queryaffMessage=$bdd->prepare("SELECT * FROM Message WHERE id_recepteur='".$userid."'");
            $queryaffMessage->execute();
            $queryaffMessage->errorinfo();
            $messages=$queryaffMessage->fetchAll();
            $queryaffMessage->CloseCursor();*/
            $messages=$bdd->getMessages($userid);




            //Création du tableau qui contiendra nos données
            echo "<table class='table'>
						<tr>
						<th>ID User</th>
						<th>Date de réception</th>
						<th>Expéditeur</th>
						<th>Sujet</th>
						</tr>";

            //Création d'une boucle qui ira chercher les données demandées et les affichera dans un tableau
            foreach($messages as $message){
                echo "<tr>";
                echo "<td>" . $message['id'] . "</td>";
                echo "<td>" . $message['date'] . "</td>";
                echo "<td>" . $message['id_expediteur'] . "</td>";
                echo "<td>" . $message['subject'] . "</td>";
                ?>
                <!-- Création du bouton delete / edit dans le tableau qui supprimera / editera la ligne à laquelle il est -->
                <td>
                    <form action="web/functions/delete.php" method="post">
                        <input type="hidden" name="deleteMessageTab" value="<?php echo $message['id']; ?>" />
                        <input class='btn btn-danger btn-sm' type="submit" value="Delete" />
                    </form>
                </td>
                <td>
                    <form action= "<?php echo'?page=writeMessage'?>" method="post">
                        <input type="hidden" name="answerTab" value="<?php echo $message['id_expediteur']; ?>" />
                        <input class='btn btn-secondary btn-sm' type="submit" value="Answer" />
                    </form>
                </td>
                <td>
                    <form action= "<?php echo'?page=messageDetails'?>" method="post">
                        <input type="hidden" name="messageDetailsTab" value="<?php echo $message['id']; ?>" />
                        <input class='btn btn-secondary btn-sm' type="submit" value="Details" />
                    </form>
                </td>
                <?php
                echo "</tr>";
            }
            echo "</table>";
            ?>
            <h4>
    </div>
</div>



<!-- Inclusion du header avec lien vers les fichiers css et les scripts js -->
<head>
    <!-- Inclusion du header avec lien vers les fichiers css et les scripts js -->
    <title>WatchOut</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- jquery permettant le lancement du bootsrap javascript-->
    <script src="js/jQuery.min.js"></script>
    <!--Fichier du thème-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/memenu.js"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <!--Déroulement facilité de la page-->

</head>

</html>