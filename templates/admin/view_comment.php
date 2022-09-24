<?php
$title = "Commentaire id : $comment->id";
ob_start();
require('templates/admin/navbar.php');
?>
<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="col-lg-10">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fs-4">Commentaire id : <?= $comment->id ?></h1>
                </div>
                <article>
                    <!-- comment content-->
                    <section class="mb-5">
                        <div class="fs-6 mb-2">
                            <p>le <?= $comment->frenchCreationDate ?></p>
                            <p><strong><?= $comment->author ?></strong> a commenté : </p>
                            <p>"<?= $comment->comment ?>"</p>
                        </div>
                    </section>
                    <!-- parent comment content-->
                    <?php if ($parentComment != null) { ?>
                        <section class="mb-5">
                            <div class="fs-6 mb-2">
                                <p>En reponse au commentaire de <strong><?= $parentComment->author ?></strong> :</p>
                                <p>"<?= $parentComment->comment ?>"</p>
                                <a href="index.php?action=viewComment&id=<?= $parentComment->id ?>">Voir le commentaire.</a>
                            </div>
                        </section>
                    <?php } else { ?>
                        <section class="mb-5">
                            <div class="fs-6 mb-2">
                                <p><strong>Article id : </strong><?= $post->id ?></p>
                                <p><strong>Titre : </strong><?= $post->title ?></p>
                                <p><strong>publié le : </strong><?= $post->frenchCreationDate ?></p>
                                <p><strong>auteur : </strong><?= $post->author ?></p>
                                <a href="index.php?action=viewPost&id=<?= $post->id ?>">Voir l'article.</a>
                            </div>
                        </section>
                    <?php } ?>
                </article>
                <!-- comment status -->
                <form action="index.php?action=viewComment&id=<?= $comment->id ?>" method="post">
                    <label class="fs-6 mb-3"><strong>Status du commentaire :</strong></label>
                    <select class="form-select mb-4" name="status" aria-label="Default select example">
                        <option value="1" <?php if ($comment->status == 'validated') echo 'selected' ?>>Validé</option>
                        <option value="2" <?php if ($comment->status == 'not_validated') echo 'selected' ?>>Non validé</option>
                        <option value="3" <?php if ($comment->status == 'waiting_for_validation') echo 'selected' ?>>En attente de validation</option>
                    </select>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        <button class="btn btn-primary" type="submit">Sauvegarder</button>
                        <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteComment-<?= $comment->id ?>" role="button">Supprimer</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<!-- delete comment modal -->
<div class="modal fade" id="deleteComment-<?= $comment->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression de commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn-danger" href="index.php?action=deleteComment&id=<?= $comment->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>