<?php
$title = "Articles";
ob_start();
require 'templates/admin/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php require 'templates/admin/sidebar.php' ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Articles</h1>
            </div>

            <!-- <h2>Liste des articles</h2> -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <a class="btn btn-primary" href="index.php?action=newPost" role="button">Nouvel article</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Nombre de commentaires</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Date de mise à jour</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($postsWithCommentsNb as $post) {
                        ?>
                            <tr>
                                <td><?= $post[0]->id ?></td>
                                <td><?= $post[0]->title ?></td>
                                <td><?= $post[0]->author ?></td>
                                <td><?= $post[1] ?></td>
                                <td><?= $post[0]->frenchCreationDate ?></td>
                                <td><?= $post[0]->frenchModificationDate ?></td>
                                <td><a href="index.php?action=viewPost&id=<?= $post[0]->id ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                                <td><a href="index.php?action=editPost&id=<?= $post[0]->id ?>" class="text-decoration-none fa-sharp fa-solid fa-pen"></a></td>
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#deletePost-<?= $post[0]->id ?>" class="text-decoration-none fa-solid fa-trash-can"></a></td>
                            </tr>

                            <!-- delete post modal -->
                            <div class="modal fade" id="deletePost-<?= $post[0]->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Suppression de l'article</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer ?</p>
                                            <div class="d-md-flex justify-content-md-end">
                                                <a type="button" class="btn btn-danger" href="index.php?action=deletePost&id=<?= $post[0]->id ?>" role="button">Confirmer</a>
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
                        <a class="page-link" href="index.php?action=posts&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=posts&page=<?= $page ?>"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=posts&page=<?= $currentPage + 1 ?>" aria-label="Next">
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
require 'templates/admin/layout.php'
?>