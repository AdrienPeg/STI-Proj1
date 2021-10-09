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
	#	Page: home.php (Affichage de la page d'accueil)
	#
	################################################################	
?>

<!DOCTYPE html>
<html>

<body>
<div class="container">
	<div class="row">
		<div align="center" style="height:400px;">
			<h1 align="center">Bienvenue sur la messagerie </h1>
			<h2 align="center">Projet STI</h2> </br> </br>
			<h5 align="center">Auteurs : Adrien Peguiron, Nicolas Viotti</h5>
            <form action= "<?php echo'?page=messages'?>" method="post">
                <input type="hidden" name="userid" value="<?php echo '2'; ?>" />
                <input class='btn btn-secondary btn-sm' type="submit" value="messages" />
            </form>
		</div>
	</div>
</div>
</body>

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