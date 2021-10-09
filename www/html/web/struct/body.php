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
    #   Page: body.php (Traitement des paramètre mis dans l'URL pour affichage du contenu du site)
    #
    #################################################################

	//On verifie si un parametre a été transmis dans l'URL, si c'est le cas on inclut la page demandé
	
	if(isset($_GET['page']))
	{
		if($_GET['page'] == "messages")
		{
			include ("web/view/messages.php");
		}
        if($_GET['page'] == "messageDetails")
        {
            include ("web/view/messageDetails.php");
        }
        if($_GET['page'] == "writeMessage")
        {
            include ("web/view/writeMessage.php");
        }
        if($_GET['page'] == "users")
        {
            include ("web/view/users.php");
        }
        if($_GET['page'] == "userEdit")
        {
            include ("web/view/userEdit.php");
        }
        if($_GET['page'] == "userCreation")
        {
            include ("web/view/userCreation.php");
        }
	}
	else
	{
		include ("web/view/home.php");
	}
	
	
?>