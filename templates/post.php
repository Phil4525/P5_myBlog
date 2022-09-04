<?php @session_start(); ?>

<?php $title = "Post"; ?>

<?php ob_start(); ?>

<?php require('navbar.php') ?>

<!-- Page content-->
<div class="container masthead d-flex flex-column">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">mis à jour le <?= $post['french_creation_date'] ?></div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><strong><?= $post['chapo'] ?></strong></p>
                    <p class="fs-6 mb-4"><?= $post['content'] ?></p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
                            <div class="form-group mb-5">
                                <textarea class="form-control mb-2" rows="3" name="comment" placeholder="leave a comment!"></textarea>
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($comments) && $comments !== null) {
                            foreach ($comments as $comment) {
                        ?>
                                <div class="d-flex" id="<?= $comment['id'] ?>">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?= $comment['author'] ?></div>
                                        <div><small>le <?= $comment['french_creation_date'] ?></small></div>
                                        <p><?= $comment['comment'] ?></p>
                                        <?php
                                        if (isset($_SESSION['user']) && $_SESSION['user']['username'] == $comment['author']) {
                                        ?>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#updateComment"><small>(Modifier)</small></a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                        <?php
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
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
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

<!-- Modal upadate comment -->
<div class="modal fade" id="updateComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mb-4" action="index.php?action=updateComment&id=<?= $comment['id'] ?>" method="post">
                    <div class="form-group mb-5">
                        <textarea class="form-control mb-2" rows="3" name="comment" placeholder="update your comment!"><?= $comment['comment'] ?></textarea>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php require('footer.php'); ?>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>