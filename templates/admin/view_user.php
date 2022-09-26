<?php
$title = "Utilisateur id: $user->id";
ob_start();
require 'templates/admin/navbar.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php require 'templates/admin/sidebar.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="col-lg-10">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fs-4">Utilisateur id: <?= $user->id ?></h1>
                </div>
                <article>
                    <section class="mb-4">
                        <p class="fs-6 mb-4"><strong>Nom :</strong> <?= $user->username ?></p>
                        <p class="fs-6 mb-4"><strong>Email :</strong> <?= $user->email ?></p>
                        <p class="fs-6 mb-4" style="word-wrap:break-word;"><strong>Mot de passe :</strong> <?= $user->password ?></p>
                        <p class="fs-6 mb-4"><strong>Date d'inscription :</strong> <?= $user->frenchCreationDate ?></p>
                        <p class="fs-6 mb-4"><strong>Nombre de commentaires :</strong> <?= $userCommentsNb ?></p>
                        <?php if ($lastUserComment != null) { ?>
                            <p class="fs-6 mb-4"><strong>Dernier commentaire le :</strong> <?= $lastUserComment->frenchCreationDate ?></p>
                        <?php } ?>
                    </section>
                </article>
                <form action="index.php?action=viewUser&id=<?= $user->id ?>" method="post">
                    <label class="mb-3 fs-6"><strong>Rôle :</strong></label>
                    <select class="form-select mb-4" name="role" aria-label="Default select example">
                        <option value="1" <?= $user->role == 'user' ? 'selected' : '' ?>>Utilisateur</option>
                        <option value="2" <?= $user->role == 'admin' ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        <button class="btn btn-primary" type="submit">Sauvegarder</button>
                        <a type="button" class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteUser-<?= $user->id ?>" role="button">Supprimer</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<!-- delete user modal -->
<div class="modal fade" id="deleteUser-<?= $user->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppresssion d'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn-danger" href="index.php?action=deleteUser&id=<?= $user->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php'
?>