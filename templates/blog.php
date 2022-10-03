<?php
ob_start();
$title = "Blog";
require 'headers/blog.php';
?>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="index.php?action=post&id=<?= urlencode($featuredPost->id) ?>"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted"><?= $featuredPost->frenchCreationDate ?></div>
                    <h2 class="card-title"><?= $featuredPost->title ?></h2>
                    <p class="card-text"><?= $featuredPost->chapo ?></p>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="index.php?action=post&id=<?= urlencode($featuredPost->id) ?>">Read more →</a>
                    </div>
                </div>
            </div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row" id="posts">
                <?php foreach ($posts as $post) { ?>
                    <div class="col-lg-6 pb-4">
                        <div class="card mb-4 h-100">
                            <a href="index.php?action=post&id=<?= urlencode($post->id) ?>"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?= $post->frenchCreationDate ?></div>
                                <h2 class="card-title h4"><?= $post->title ?></h2>
                                <p class="card-text text-truncate"><?= strip_tags($post->chapo)  ?></p>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary" href="index.php?action=post&id=<?= urlencode($post->id) ?>">Read more →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=blog&page=<?= urlencode($currentPage) - 1 ?>#posts" aria-label="Previous">
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=blog&page=<?= urlencode($page) ?>#posts"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=blog&page=<?= urlencode($currentPage) + 1 ?>#posts" aria-label="Next">
                            <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </nav>
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
$content = ob_get_clean();
require 'layout.php';
?>