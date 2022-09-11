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
                <h1 class="h2">Article id: <?= $post->id ?></h1>
            </div>
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post->title ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">mis à jour le <?= $post->frenchCreationDate ?></div>
                    <div class="text-muted fst-italic mb-2">par <?= $post->author ?></div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><strong><?= $post->chapo ?></strong></p>
                    <p class="fs-6 mb-4"><?= $post->content ?></p>
                </section>
            </article>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <a class="btn btn-primary" href="index.php?action=editPost&id=<?= $post->id ?>" role="button">Editer</a>
                <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deletePost-<?= $post->id ?>" role="button">Supprimer</a>
            </div>
        </main>
    </div>
</div>
<!-- delete post modal -->
<div class="modal fade" id="deletePost-<?= $post->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="index.php?action=deletePost&id=<?= $post->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>