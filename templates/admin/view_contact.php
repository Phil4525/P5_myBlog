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
                <h1 class="h2">Message id: <?= $contact->id ?></h1>
            </div>
            <article>
                <!-- contact header-->
                <header class="mb-4">
                    <!-- contact meta content-->
                    <div class="text-muted fst-italic mb-2">le <?= $contact->frenchCreationDate ?></div>
                    <!-- <div class="text-muted fst-italic mb-2"><?= $contact->email ?></div> -->
                    <a class="text-muted fst-italic mb-2" href="mailto:<?= $contact->email ?>"><?= $contact->email ?></a>
                    <div class="text-muted fst-italic mb-2">tel : <?= $contact->phone ?></div>
                    <div class="text-muted fst-italic mb-2"><?= $contact->fullname ?> a écrit: </div>
                </header>
                <!-- contact content-->
                <section class="mb-5">
                    <p class="fs-6 mb-4"><?= nl2br(strip_tags($contact->messageContent)) ?></p>
                </section>
            </article>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteContact-<?= $contact->id ?>" role="button">Supprimer</a>
            </div>
        </main>
    </div>
</div>
<!-- delete contact modal -->
<div class="modal fade" id="deleteContact-<?= $contact->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="index.php?action=deleteContact&id=<?= $contact->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>