<?php
$title = "Articles";
ob_start();
require('templates/admin/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Commentaire id: <?= $comment['id'] ?></h1>
            </div>
            <article>
                <!-- Comment header-->
                <header class="mb-4">
                    <!-- comment meta content-->
                    <div class="text-muted fst-italic mb-2">le <?= $comment['french_creation_date'] ?></div>
                    <div class="text-muted fst-italic mb-2"><?= $comment['author'] ?> a commenté: </div>
                </header>
                <!-- comment content-->
                <section class="mb-5">
                    <p class="fs-6 mb-4"><?= $comment['comment'] ?></p>
                </section>
            </article>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteComment-<?= $comment['id'] ?>" role="button">Supprimer</a>
            </div>
        </main>
    </div>
</div>
<!-- delete comment modal -->
<div class="modal fade" id="deleteComment-<?= $comment['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="index.php?action=deleteComment&id=<?= $post['id'] ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>