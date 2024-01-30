<?php
session_start();

require_once(__DIR__.'/isConnect.php');
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

//vérification du POST

$postData=$_POST;
if(
    empty($postData['ID_livre']) ||
    !is_numeric($postData['ID_livre']) ||
    trim(strip_tags($postData['comment'])) ===''
){
    echo 'il n\'est pas possible de faire un commentaire';
    var_dump($postData);
    return;
}

$ID_livre=$postData['ID_livre'];
$comment=trim(strip_tags($postData['comment']));

$insertComment=$mysqlClient->prepare('INSERT INTO comments(ID_livre, id_user, comment) VALUES (:ID_livre, :id_user, :comment)');
$insertComment->execute([
    'ID_livre'=>$ID_livre,
    'id_user'=>$_SESSION['LOGGED_USER']['id_user'],
    'comment'=>$comment,
]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliothèque - Création de commentaire</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__.'/header.php'); ?>
        <h1>Commentaire ajouté avec succès</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><b>Votre commentaire : </b><?php echo strip_tags($comment);?></p>
            </div>
        </div>
    </div>
    <?php require_once(__DIR__.'/footer.php');?>
</body>
</html>

<?php header("Location: index.php");
exit();