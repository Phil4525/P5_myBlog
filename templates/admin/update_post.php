<?php
ob_start();
$title = $post->title;
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="col-lg-10">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="fs-4">Article id:<?= $post->id ?></h1>
        </div>
        <form class="mb-5" action="index.php?action=editPost&id=<?= urlencode($post->id) ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $post->title ?>">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label fw-bold">Auteur</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= $post->author ?>">
            </div>
            <div class="mb-3">
                <label for="chapo" class="form-label fw-bold">Chapô</label>
                <textarea class="tiny" id="chapo" name="chapo" rows="3"><?= $post->chapo ?></textarea>
            </div>
            <div class="form-outline mb-4">
                <label for="tiny" class="form-label fw-bold">Corps du texte</label>
                <textarea class="tiny" name="content"><?= $post->content  ?></textarea>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deletePost-<?= $post->id ?>" role="button">Supprimer</a>
            </div>
        </form>
    </div>
</main>
<!-- delete post modal -->
<div class="modal fade" id="deletePost-<?= $post->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression de l'article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn-danger" href="index.php?action=deletePost&id=<?= urlencode($post->id) ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php'
?>