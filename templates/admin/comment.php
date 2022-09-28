<?php
$title = "Posts";

use App\Lib\HtmlCleaner;

$htmlcleaner = new HtmlCleaner();
ob_start();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Commentaires</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Auteur</th>
                    <!-- <th scope="col">Commentaire</th> -->
                    <th scope="col">Article</th>
                    <th scope="col">Id de l'article</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commentsWithPostTitle as $comment) { ?>
                    <tr>
                        <td><?= $htmlcleaner->clean($comment[0]->id) ?></td>
                        <td><?= $htmlcleaner->clean($comment[0]->author) ?></td>
                        <td><?= $htmlcleaner->clean($comment[1]) ?></td>
                        <td><?= $htmlcleaner->clean($comment[0]->postId) ?></td>
                        <td><?= $htmlcleaner->clean($comment[0]->frenchCreationDate) ?></td>
                        <td><?= $htmlcleaner->clean($comment[0]->status) ?></td>
                        <td><a href="index.php?action=viewComment&id=<?= $comment[0]->id ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                        <td><a href="" data-bs-toggle="modal" data-bs-target="#deleteComment-<?= $comment[0]->id ?>" class="text-decoration-none fa-solid fa-trash-can"></a></td>
                    </tr>
                    <!-- delete post modal -->
                    <div class="modal fade" id="deleteComment-<?= $comment[0]->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Suppression de commentaire</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Etes-vous sûr de vouloir supprimer ?</p>
                                    <div class="d-md-flex justify-content-md-end">
                                        <a type="button" class="btn btn-danger" href="index.php?action=deleteComment&id=<?= $comment[0]->id ?>&page=<?= $currentPage ?>" role="button">Confirmer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination-->
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center my-4 pagination-sm">
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a class="page-link" href="index.php?action=comments&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                    <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                </a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                    <a class="page-link" href="index.php?action=comments&page=<?= $page ?>"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a class="page-link" href="index.php?action=comments&page=<?= $currentPage + 1 ?>" aria-label="Next">
                    <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                </a>
            </li>
        </ul>
    </nav>
</main>
<script src="js/sorting.js"></script>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php';
?>