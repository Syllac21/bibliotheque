<?php
session_start();
require_once(__DIR__.'/isConnect.php');

$getData = $_GET;

if(!isset($getData['id']) || !is_numeric($getData['id'])){
    echo('Je ne trouve pas la recette');
    return;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliothèque - Supprimer la recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__.'/header.php');?>
        <h1>Supprimer le livre</h1>
        <form action="book_post_delete.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-lavel">Identifiant du livre</label>
                <input type="hidden" class="form_control" name="id" id="id" value="<?php echo $getData['id']; ?>">
            </div>
            <button type="submit" class="btn btn-danger">Attention la suppression est définitive</button>
        </form>
    </div>
    <?php require_once(__DIR__.'/footer.php'); ?>
</body>
</html>