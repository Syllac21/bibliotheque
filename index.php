<?php
session_start();
// inclusion des fichiers utiles

require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma bibliothèque - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__.'/header.php');?>
        <h1>page d'Accueil</h1>
        <!-- formulaire de connexion -->
        <?php require_once(__DIR__.'/login.php');?>  
        <?php var_dump($_SESSION); ?>
    </div>

    <?php require_once(__DIR__.'/footer.php');?>
</body>
</html>
