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
                <h1 class="h2">Article id:<?= $post['id'] ?></h1>
            </div>

            <form class="mb-5" action="index.php?action=editPost&id=<?= $post['id'] ?>" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label fw-bold">Auteur</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?= $post['author'] ?>">
                </div>
                <div class="mb-3">
                    <label for="chapo" class="form-label fw-bold">Chapô</label>
                    <textarea class="tiny" id="chapo" name="chapo" rows="3"><?= nl2br($post['chapo']) ?></textarea>
                </div>
                <div class="form-outline mb-4">
                    <label for="tiny" class="form-label fw-bold">Corps du texte</label>
                    <textarea class="tiny" name="content"><?= nl2br($post['content'])  ?></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>

                </div>
            </form>

        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>