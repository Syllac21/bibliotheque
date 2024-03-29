<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ma bibliothèque - nouvel utilisateur</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
    </head>

    <body class="d-flex flex-column min-vh-100">
        <div class="container">
            <?php require_once(__DIR__ . '/header.php'); ?>
            <h1>Votre compte</h1>
            <form action="submit_new_user.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label"> Votre nom</label>
                    <input type="text" name="nom" class="nom" id="nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label"> Votre prénom</label>
                    <input type="text" name="prenom" class="form-text" id="prenom">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@exemple.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </body>
</html>