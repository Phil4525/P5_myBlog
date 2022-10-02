<?php
$title = "Home";
ob_start();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="col-lg-10">
        <?php if ($resultsNb > 0) { ?>
            <?php if ($resultsNb > 1) { ?>
                <p><?= $resultsNb ?> résultats trouvés pour le terme "<?= $keyword ?>"</p>
            <?php } else { ?>
                <p><?= $resultsNb ?> résultat trouvé pour le terme "<?= $keyword ?>"</p>
            <?php } ?>
            <?php foreach ($results as $result) { ?>
                <?php if (get_class($result) == 'App\Model\Post') { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p><strong>Article</strong></p>
                            <h2 class="card-title h5"><?= $result->title ?></h2>
                            <div class="small text-muted">publié le <?= $result->frenchCreationDate ?></div>
                            <div class="small text-muted">auteur : <?= $result->author ?></div>
                            <p class="card-text text-truncate"><?= strip_tags($result->chapo) ?></p>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" href="index.php?action=viewPost&id=<?= $result->id ?>">Read more →</a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title h5">Commentaire de <?= $result->author ?></h2>
                            <div class="small text-muted">publié le <?= $result->frenchCreationDate ?></div>
                            <p class="card-text text-truncate"><?= strip_tags($result->comment) ?></p>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" href="index.php?action=viewComment&id=<?= $result->id ?>">Read more →</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminSearch&keyword=<?= $keyword ?>&page=<?= $currentPage - 1 ?>#results" aria-label="Previous">
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=adminSearch&keyword=<?= $keyword ?>&page=<?= $page ?>#results"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminSearch&keyword=<?= $keyword ?>&page=<?= $currentPage + 1 ?>#results" aria-label="Next">
                            <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php } else { ?>
            <p>Aucun résultat trouvé pour le terme "<?= $keyword ?>".</p>
        <?php } ?>
    </div>
</main>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php';
?>