<?php
$title = "Utilisateur";
ob_start();
require('templates/admin/navbar.php');
?>
<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Utilisateur id: <?= $user->id ?></h1>
            </div>
            <article>
                <section class="mb-5">
                    <p class="fs-6 mb-4">Nom: <?= $user->username ?></p>
                    <p class="fs-6 mb-4">Email: <?= $user->email ?></p>
                    <p class="fs-6 mb-4">Mot de passe: <?= $user->password ?></p>
                    <p class="fs-6 mb-4">Date d'inscription: <?= $user->frenchCreationDate ?></p>
                </section>
            </article>
            <form action="index.php?action=viewUser&id=<?= $user->id ?>" method="post">
                <label class="mb-3">Role</label>
                <select class="form-select mb-4" name="role" aria-label="Default select example">
                    <option value="1" <?php if ($user->role == 'user') echo 'selected' ?>>Utilisateur</option>
                    <option value="2" <?php if ($user->role == 'admin') echo 'selected' ?>>Administrateur</option>
                </select>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                    <button class="btn btn-primary" type="submit">Sauvegarder</button>
                    <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#deleteUser-<?= $user->id ?>" role="button">Supprimer</a>
                </div>
            </form>
        </main>
    </div>
</div>

<!-- delete user modal -->
<div class="modal fade" id="deleteUser-<?= $user->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="index.php?action=deleteUser&id=<?= $user->id ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>