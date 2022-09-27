<?php $title = "myBlog";
ob_start();
require 'navbar.php';
?>
<!-- Page content-->
<div class="container masthead">
    <div class="row">
        <!-- Results -->
        <div class="col-lg-8" id="results">
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
                            <div class="small text-muted">publié le <?= $result->frenchCreationDate ?></div>
                            <div class="small text-muted">auteur : <?= $result->author ?></div>
                            <p class="card-text text-truncate"><?= strip_tags($result->chapo) ?></p>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" href="index.php?action=post&id=<?= $result->id ?>">Read more →</a>
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
            <?php } ?>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <?php require('templates/search_widget.php') ?>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
$content = ob_get_clean();
require 'layout.php';
?>