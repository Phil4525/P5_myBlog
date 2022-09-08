<?php
$title = "Articles";
ob_start();
require('templates/admin/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Article id: <?= $post['id'] ?></h1>
            </div>
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">mis à jour le <?= $post['french_creation_date'] ?></div>
                    <div class="text-muted fst-italic mb-2">par <?= $post['author'] ?></div>
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

        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>