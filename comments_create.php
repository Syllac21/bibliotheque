<?php
require_once(__DIR__.'/isConnect.php');
?>

<form action="comments_post_create.php" method="POST">
    <div class="mb-3 visually-hidden">
        <input class="form-control" type="text" name="ID_livre" value="<?php echo($book['ID_livre']); ?>" >
    </div>
    <div class="row">
        <article class="col">
            <div class="mb-3">
                <label for="comment" class="form-label">Postez un commentaire</label>
                <textarea class="form-control" placeholder="Soyez respectueux/se, nous sommes humain(e)s." id="comment" name="comment"></textarea>
            </div>
        </article>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>