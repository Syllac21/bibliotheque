<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

$getData=$_GET;
// on vérifie les données dans GET
if(
    !isset($getData['id']) ||
    !is_numeric($getData['id'])
){
    echo('la recette n\'existe pas');
    return;
}

// on va cherches les données concernant le livre
$retrieveBookCommentsStatement = $mysqlClient->prepare('SELECT l.*, c.comment_id, c.comment, c.id_user, u.nom, u.prenom, DATE_FORMAT(c.created_at, "%d/%m/%Y") as comment_date FROM liste_livres l
LEFT JOIN comments c ON c.ID_livre=l.ID_livre
LEFT JOIN users u ON u.id_user=c.id_user
WHERE l.ID_livre=:id ORDER BY comment_date DESC');
$retrieveBookCommentsStatement->execute([
    'id'=>(int)$getData['id'],
]);
$detailsBook=$retrieveBookCommentsStatement->fetchAll(PDO::FETCH_ASSOC);

// on vérifie qu'on a récupéré une recette
if($detailsBook===[]){
    echo('la recette n\'existe pas');
    return;
}

$book=[
    'ID_livre'=>$detailsBook[0]['ID_livre'],
    'genre'=>$detailsBook[0]['genre'],
    'titre'=>$detailsBook[0]['titre'],
    'auteur'=>$detailsBook[0]['auteur'],
    'description'=>$detailsBook[0]['description'],
    'image'=>$detailsBook[0]['image'],
    'proprio'=>$detailsBook[0]['proprio'],
    'comments'=>[],
];

foreach($detailsBook as $comment){
    if(!is_null($comment['comment_id'])){
        $book['comments'][]=[
            'comment_id'=>$comment['comment_id'],
            'created_at'=>$comment['comment_date'],
            'comment'=>$comment['comment'],
            'id_user'=>(int) $comment['id_user'],
            'nom'=> $comment['nom'],
            'prenom'=>$comment['prenom'],
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliothèque - <?php echo($book['titre']); ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="./style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__.'/header.php');?>
        <h1><?php echo($book['titre']); ?>  </h1>
        <div class="row">
            <p><?php echo($book['genre']); ?></p>
            <p><?php echo($book['auteur']); ?></p>
            <article class="col">
                <?php echo($book['description']);?>
            </article>
            <article class="col">
                <?php echo($book['image']);?>
            </article>
            <aside class="row">
                <p><i>Possédé par <?php echo($comment['proprio']);?> </i></p>
            </aside>
        </div>


        <!-- affichage des commentaires -->
        <h2>Commentaires</h2>
        <?php if($book['comments'] !== []) : ?>
        <div class="row">
            <?php foreach ($book['comments'] as $comment): ?>
                <div class="comment">
                    <p><?php echo($comment['comment']); ?> </p>
                    <i>(<?php echo($comment['nom']);?> <?php echo($comment['prenom']);?>) </i>
                    <i><?php echo($comment['created_at']);?> </i>
                </div>
            <?php endforeach;?>
        </div>
        <?php else : ?>
        <div class="row">
            <p>Aucun commentaire</p>
        </div>
        <?php endif;?>
        <?php if(isset($_SESSION['LOGGED_USER'])) : ?>
            <div class="row">
                <article class="col">
                    <?php require_once(__DIR__.'/comments_create.php');?>
                </article>
            </div>
        <?php  endif; ?>
    </div>
    <?php require_once(__DIR__.'/footer.php');?>
</body>
</html>