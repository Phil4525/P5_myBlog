<?php
$title = "Home";
ob_start();
require 'templates/admin/navbar.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php require 'templates/admin/sidebar.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
            <div class="col-lg-10">
                <?php if ($resultsNb > 0) { ?>
                    <?php if ($resultsNb > 1) { ?>
                        <p><?= $resultsNb ?> résultats trouvés pour le terme "<?= $keyword ?>"</p>
                    <?php } else { ?>
                        <p><?= $resultsNb ?> résultat trouvé pour le terme "<?= $keyword ?>"</p>
                    <?php } ?>
                    <?php foreach ($results as $result) { ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title h4"><?= $result->title ?></h2>
                                <div class="text-muted">publié le <?= $result->frenchCreationDate ?></div>
                                <div class="text-muted">auteur : <?= $result->author ?></div>
                                <p class="card-text text-truncate"><?= strip_tags($result->chapo)  ?></p>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary" href="index.php?action=viewPost&id=<?= $result->id ?>">Voir l'article →</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                <a class="page-link" href="index.php?action=search&keyword=<?= $keyword ?>&page=<?= $currentPage - 1 ?>#results" aria-label="Previous">
                                    <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                                </a>
                            </li>
                            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                                    <a class="page-link" href="index.php?action=search&keyword=<?= $keyword ?>&page=<?= $page ?>#results"><?= $page ?></a>
                                </li>
                            <?php endfor ?>
                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                <a class="page-link" href="index.php?action=search&keyword=<?= $keyword ?>&page=<?= $currentPage + 1 ?>#results" aria-label="Next">
                                    <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php } elseif ($resultsNb == 0) { ?>
                    <p>Aucun résultat trouvé pour le terme "<?= $keyword ?>".</p>
                <?php } else { ?>
                    <p> <?= $message ?></p>
                <?php } ?>
            </div>
        </main>
    </div>
    <?php
    $content = ob_get_clean();
    require 'templates/admin/layout.php';
    ?>