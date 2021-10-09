<?php
try {
// Create (connect to) SQLite database in file
    $bdd = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
// Set errormode to exceptions
    $bdd->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>

