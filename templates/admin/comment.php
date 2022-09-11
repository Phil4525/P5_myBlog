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
                <h1 class="h2">Commentaires</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Post_Id</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                            <th scope="col"></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($comments as $comment) {
                        ?>
                            <tr>
                                <td><?= $comment->id ?></td>
                                <td><?= $comment->postId ?></td>
                                <td><?= $comment->author ?></td>
                                <td><?= $comment->comment ?></td>
                                <td><?= $comment->frenchCreationDate ?></td>
                                <td><a href="index.php?action=viewComment&id=<?= $comment->id ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#deleteComment-<?= $comment->id ?>" class="text-decoration-none fa-solid fa-trash-can"></a></td>
                            </tr>
                            <!-- delete post modal -->
                            <div class="modal fade" id="deleteComment-<?= $comment->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer ?</p>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a class="btn btn-primary" href="index.php?action=deleteComment&id=<?= $comment->id ?>" role="button">Confirmer</a>
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
                <!-- <hr class="my-0" /> -->
                <ul class="pagination justify-content-center my-4 pagination-sm">
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