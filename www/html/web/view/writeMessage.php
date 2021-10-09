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
#	Page: writeMessage.php (Ecriture et envoi d'un message)
#
################################################################

?>

<!DOCTYPE html>
<html>
<script>
    function submitForm(action)
    {
        document.getElementById('formulaire').action = action;
        document.getElementById('formulaire').submit();
    }
</script>

<body>


<?php

//inclusion connexion à base de données
if( include ('/usr/share/nginx/html/web/functions/connectDB.php') ) {
} else {
    echo 'Failed to load database';
}//connexion à la base de données

$message = $bdd->query("SELECT * FROM Message WHERE Message.id = '".$_POST['messageDetailsTab']."'")->fetch();
?>
<div id="ajout-articles">
    <div style="border-bottom: 1px solid #C4C3C3;" class= "container" id ="formulaire">
        <h1 style="text-decoration: underline;">Ajout Produit :<h1>
                <h4>
                    <!-- Création du formulaire -->
                    <div class= "row">
                        <div class="col">
                            <form action="web/functions/insert.php" method="post" enctype="multipart/form-data">
                                <p>
                                    <label for="prix">Prix :</label>
                                    <input type="number" name="prix" id="prix" class="form-control" required>
                                </p>
                                <p>
                                    <label for="couleurBracelet">Couleur Bracelet :</label>
                                    <select id="couleurBracelet" name="couleurBracelet" class="form-control" required>
                                        <?php
                                        //Selection de toutes les couleurs autorisées pour le bracelet de ce modèle.
                                        $query = "SELECT * FROM Modele_Couleur_Bracelet WHERE Modele_Couleur_Bracelet.idModele =".$modele['id'];
                                        $couleursB = $bdd->query($query)->fetchAll();
                                        foreach($couleursB as $row) {
                                            $couleurNom = $bdd->query("SELECT * FROM couleur WHERE couleur.id =".$row['idCouleur'])->fetch();
                                            echo "<option value='{$row['idCouleur']}' selected='selected'>{$couleurNom['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="couleurBoitier">Couleur Boîtier :</label>
                                    <select id="couleurBoitier" name="couleurBoitier" class="form-control" required>
                                        <?php
                                        //Selection de toutes les couleurs autorisées pour le boitier de ce modèle.
                                        $query = "SELECT * FROM Modele_Couleur_Boitier WHERE Modele_Couleur_Boitier.idModele =".$modele['id'];
                                        $couleursB = $bdd->query($query)->fetchAll();
                                        foreach($couleursB as $row) {
                                            $couleurNom = $bdd->query("SELECT * FROM couleur WHERE couleur.id =".$row['idCouleur'])->fetch();
                                            echo "<option value='{$row['idCouleur']}' selected='selected'>{$couleurNom['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="couleurCadran">Couleur Cadran :</label>
                                    <select id="couleurCadran" name="couleurCadran"  class="form-control" required>
                                        <?php
                                        //Selection de toutes les couleurs autorisées pour le cadran de ce modèle.
                                        $query = "SELECT * FROM Modele_Couleur_Cadran WHERE Modele_Couleur_Cadran.idModele =".$modele['id'];
                                        $couleursB = $bdd->query($query)->fetchAll();
                                        foreach($couleursB as $row) {
                                            $couleurNom = $bdd->query("SELECT * FROM couleur WHERE couleur.id =".$row['idCouleur'])->fetch();
                                            echo "<option value='{$row['idCouleur']}' selected='selected'>{$couleurNom['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </p>
                        </div>
                        <div class="col">
                            <p>
                                <label for="matiereBoitier">Matière Boîtier :</label>
                                <select id="matiereBoitier" name="matiereBoitier"  class="form-control" required>
                                    <?php
                                    //Selection de toutes les couleurs autorisées pour le bracelet de ce modèle. Valeur par défaut = valeur utilisée par le produit
                                    $query = "SELECT * FROM Modele_Matiere_Boitier WHERE Modele_Matiere_Boitier.idModele =".$modele['id'];
                                    $couleursB = $bdd->query($query)->fetchAll();
                                    foreach($couleursB as $row) {
                                        $matiereNom = $bdd->query("SELECT * FROM matiere WHERE matiere.id =".$row['idMatiereBoitier'])->fetch();
                                        echo "<option value='{$row['idMatiereBoitier']}' selected='selected'>{$matiereNom['nom']}</option>";
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <label for="matiereBracelet">Matière Bracelet :</label>
                                <select id="matiereBracelet" name="matiereBracelet"  class="form-control" required>
                                    <?php
                                    //Selection de toutes les matières autorisées pour le bracelet de ce modèle.
                                    $query = "SELECT * FROM Modele_Matiere_Bracelet WHERE Modele_Matiere_Bracelet.idModele =".$modele['id'];
                                    $couleursB = $bdd->query($query)->fetchAll();
                                    foreach($couleursB as $row) {
                                        $matiereNom = $bdd->query("SELECT * FROM matiere WHERE matiere.id =".$row['idMatiereBracelet'])->fetch();
                                        echo "<option value='{$row['idMatiereBracelet']}' selected='selected'>{$matiereNom['nom']}</option>";
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <label for="fermoir">Fermoir :</label>
                                <select id="fermoir" name="fermoir"  class="form-control" required>
                                    <?php
                                    //Selection de tous les fermoirs.
                                    $query = "SELECT * FROM fermoir";
                                    $fermoirs = $bdd->query($query)->fetchAll();
                                    foreach($fermoirs as $row) {
                                        echo "<option value='{$row['id']}' selected='selected'>{$row['fermoirBracelet']}</option>";
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <label for="lienMedia">Image :</label>
                                <input type="file" name="lienMedia" id="lienMedia" class="form-control">
                            </p>
                            <input type="hidden" name="insertProduct" value="<?php echo $row['id']; ?>"/>
                            <input class='btn btn-secondary btn-md' type="submit" value="Ajouter" style="float:right;" />
                            </form>
                        </div>
                    </div>
                    <h4>
    </div>
</div>
</br>
</body>

<!-- Inclusion des fichiers css et javascript -->
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