<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$getData=$_GET;

if (empty($getData['id']) || !is_numeric($getData['id'])){
    echo('je ne trouve pas le livre');
    return;
}

$retrieveBookStatement=$mysqlClient->prepare('SELECT * FROM liste_livres WHERE ID_livre=:id');
$retrieveBookStatement->execute([
    'id'=>$id,
]);
$book=$retrieveBookStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliothèque - modification de la fiche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__.'header.php');?>
        <h1>Modifier la fiche</h1>
        <form action="book_post_update.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant du livre</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']);?>">
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre du livre</label>
                <input type="text" name="genre" class="form-text" id="genre" value="<?php echo($book['genre']);?>">
            </div>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du livre</label>
                <input type="text" name="titre" class="form-text" id="titre" value="<?php echo($book['titre']);?>">
            </div>
            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur du livre</label>
                <input type="text" name="auteur" class="form-text" id="auteur" value="<?php echo($book['auteur']);?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Résumé du livre</label>
                <textarea name="description" class="form-control" id="description" placeholder="votre résumé" value="<?php echo($book['description']);?>"></textarea>
            </div>

            <!-- upload de l'image -->
            
            <div class="mb-3">
                    <input type="hidden" name="max_file_size" value="5000000">
                    <label for="image" class="form-label">image</label>
                    <input type="file" name="image" class="form-text" id="image" value="<?php echo($book['image']);?>">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
    
</body>
</html>