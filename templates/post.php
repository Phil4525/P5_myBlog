<?php
$title = $post->title;
ob_start();
require 'navbar.php';
?>
<!-- Page content-->
<div class="container masthead d-flex flex-column">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post->title ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">publié le <?= $post->frenchCreationDate ?></div>
                    <?php if (isset($post->frenchModificationDate)) { ?>
                        <div class="text-muted fst-italic mb-2">mis à jour le <?= $post->frenchModificationDate ?></div>
                    <?php } ?>
                    <div class="text-muted fst-italic mb-2">par <?= $post->author ?></div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><strong><?= $post->chapo ?></strong></p>
                    <p class="fs-6 mb-4"><?= $post->content ?></p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="index.php?action=addComment&id=<?= $post->id ?>" method="post">
                            <div class="form-group mb-5">
                                <textarea class="form-control mb-2" rows="3" name="comment" placeholder="leave a comment!"></textarea>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                        <!--parent comment -->
                        <?php
                        if (isset($comments) && $comments !== null) {
                            foreach ($comments as $comment) {
                                require 'templates/comment.php';
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
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