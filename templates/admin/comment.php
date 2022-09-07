<?php
$title = "Posts";
ob_start();
require('templates/admin/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Liste des commentaires</h1>
                <!-- <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar" class="align-text-bottom"></span>
                        This week
                    </button>
                </div> -->
            </div>

            <!-- <h2>Liste des articles</h2> -->
            <!-- <a class="btn btn-primary" href="#" role="button">Créer un nouvel article</a> -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Post_Id</th>
                            <!-- <th scope="col">Chapô</th> -->
                            <!-- <th scope="col">Contenu</th> -->
                            <th scope="col">Auteur</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Date</th>
                            <!-- <th scope="col">Validation</th> -->
                            <th scope="col"></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($comments as $comment) {
                        ?>
                            <tr>
                                <td><?= $comment['id'] ?></td>
                                <td><?= $comment['post_id'] ?></td>
                                <td><?= $comment['author'] ?></td>
                                <td><?= $comment['comment'] ?></td>
                                <td><?= $comment['french_creation_date'] ?></td>
                                <!-- <td><a href="index.php?action=editComment&id=<?= $post['id'] ?>" class="fa-sharp fa-solid fa-pen"></a></td> -->
                                <td><a href="index.php?action=deleteComment&id=<?= $comment['id'] ?>" class="fa-solid fa-trash-can"></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <!-- <hr class="my-0" /> -->
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminComments&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                            <!-- <span aria-hidden="true">&laquo;</span> -->
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=adminComments&page=<?= $page ?>"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminComments&page=<?= $currentPage + 1 ?>" aria-label="Next">
                            <!-- <span aria-hidden="true">&raquo;</span> -->
                            <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>