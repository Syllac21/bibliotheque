<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');

$postData=$_POST;

// validation des données

if(
    trim(strip_tags($postData['genre']))==='' ||
    trim(strip_tags($postData['titre']))==='' ||
    trim(strip_tags($postData['auteur']))==='' ||
    trim(strip_tags($postData['description']))===''
){
    echo('tous les champs sont obligatoires');
    exit;
}

//validation du fichier

// définition des variables
$id=$postData['id'];
$dossier='images/';
$fichier=basename($_FILES['image']['name']);
$taille_max=5000000;
$taille=filesize($_FILES['image']['tmp_name']);
$extensions_ok=['.png','.gif','.jpg','.jpeg'];
$extension=strrchr($_FILES['image']['name'],'.');

if(!empty($_FILES['image']['name'])){

// vérification de l'extension
    if(!in_array($extension,$extensions_ok)){$erreur= 'vous devez uploader un fichier image';}

    // je vérifie la taille
    if($taille>$taille_max){$erreur='votre fichier est trop volumineux';}

    if(!isset($erreur)){
        //remplacement des caractère avec des accents
        $fichier=strtr($fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        //déplacement du fichier de son adresse temporaire au dossier image
        if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichier)){
            echo'téléchargement OK';
        }
        else{
            echo'Erreur de téléchargement';
            exit;
        }
    }
    else{
        echo($erreur);
        exit;
    }
}
else{$image='images/pas-image.webp';}

$genre=trim(strip_tags($postData['genre']));
$titre=trim(strip_tags($postData['titre']));
$auteur=trim(strip_tags($postData['auteur']));
$description=trim(strip_tags($postData['description']));

$insertBookStatement=$mysqlClient->prepare('UPDATE liste_livres SET genre=:genre, titre=:titre auteur=:auteur description=:description image=:image proprio=:proprio');
$insertBookStatement->execute([
    'genre'=>$genre,
    'titre'=>$titre,
    'auteur'=>$auteur,
    'description'=>$description,
    'image'=>$dossier.$fichier,
    'proprio'=>$_SESSION['LOGGED_USER']['email'],
]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliothèque - Modificaion de la fiche</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__.'/header.php'); ?>
    <h1>La fiche a bien été modifiée</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo($titre);?></h5>
            <p class="card-text"><b>Email</b> : <?php $_SESSION['LOGGED_USER']['email']; ?></p>
            <p class="card-text"><b>Genre</b> : <?php echo $genre;?> </p>
            <p class="card-text"><b>Auteur</b> : <?php echo $auteur;?> </p>
            <p class="card-text"><b>description</b> : <?php echo $description;?> </p>
            <img src="./<?php echo $image;?>" alt="image du livre" class="card-img-top">
        </div>
    </div>
</body>
</html>