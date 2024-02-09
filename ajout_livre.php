<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma bibliothèque - Nouveau livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body class="d-flex flex-column min-vh-100" >
    <div class="container">
        <?php require_once(__DIR__.'/header.php'); ?>
        <h1>Nouveau livre</h1>
        <form action="submit_ajout_livre.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="genre" class="form-label">Genre du livre</label>
                <input type="text" name="genre" class="form-text" id="genre">
            </div>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du livre</label>
                <input type="text" name="titre" class="form-text" id="titre">
            </div>
            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur du livre</label>
                <input type="text" name="auteur" class="form-text" id="auteur">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Résumé du livre</label>
                <textarea name="description" class="form-control" id="description" placeholder="votre résumé"></textarea>
            </div>

            <!-- upload de l'image -->
            
            <div class="mb-3">
                    <input type="hidden" name="max_file_size" value="5000000">
                    <label for="image" class="form-label">image</label>
                    <input type="file" name="image" class="form-text" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
            
            
        </form>
    </div>
</body>
</html>