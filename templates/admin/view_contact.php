<?php
$title = "Contact id: $contact->id";
ob_start();
require 'templates/admin/navbar.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php require 'templates/admin/sidebar.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="col-lg-10">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fs-4">Contact id: <?= $contact->id ?></h1>
                </div>
                <article>
                    <!-- contact header-->
                    <header class="mb-4">
                        <!-- contact meta content-->
                        <p class="mb-2 fs-6"><strong>email : </strong><a class="mb-2 fs-6" href="mailto:<?= $contact->email ?>"><?= $contact->email ?></a></p>
                        <p class="mb-2 fs-6"><strong>telephone : </strong><a class="mb-2 fs-6" href="tel:+<?= $contact->phone ?>"><?= $contact->phone ?></a></p>

                        <p class="mb-2 fs-6">le <?= $contact->frenchCreationDate ?></p>
                        <p class="mb-2 fs-6"><strong><?= $contact->fullname ?></strong> a écrit: </p>
                    </header>
                    <!-- contact content-->
                    <section class="mb-5">
                        <p class="fs-6 mb-4"><?= $contact->messageContent ?></p>
                    </section>
                </article>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                    <a class="btn btn-primary" href="mailto:<?= $contact->email ?>" role="button">Repondre</a>
                    <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteContact-<?= $contact->id ?>" role="button">Supprimer</a>
                </div>
            </div>

        </main>
    </div>
</div>
<!-- delete contact modal -->
<div class="modal fade" id="deleteContact-<?= $contact->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression de demande de contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn-danger" href="index.php?action=deleteContact&id=<?= $contact->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php'
?>