<?php
$title = "Users";
ob_start();
require 'templates/admin/navbar.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php require 'templates/admin/sidebar.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Utilisateurs</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nombre de commentaires</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Date d'inscription</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($usersWithCommentsNb as $user) {
                        ?>
                            <tr>
                                <td><?= $user[0]->id ?></td>
                                <td><?= $user[0]->username ?></td>
                                <td><?= $user[0]->email ?></td>
                                <td><?= $user[1] ?></td>
                                <td><?= $user[0]->role ?></td>
                                <td><?= $user[0]->frenchCreationDate ?></td>
                                <td><a href="index.php?action=viewUser&id=<?= $user[0]->id ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                                <td><a href="" class="text-decoration-none fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deleteUser-<?= $user[0]->id ?>"></a></td>
                            </tr>
                            <!-- delete user modal -->
                            <div class="modal fade" id="deleteUser-<?= $user[0]->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Suppresssion d'utilisateur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer ?</p>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a class="btn btn-primary" href="index.php?action=deleteUser&id=<?= $user[0]->id ?>" role="button">Confirmer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center my-4 pagination-sm">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=users&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=users&page=<?= $page ?>"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=users&page=<?= $currentPage + 1 ?>" aria-label="Next">
                            <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>
<script src="js/sorting.js"></script>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php';
?>