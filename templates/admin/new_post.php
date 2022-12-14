<?php
ob_start();
$title = "Nouvel article";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="col-lg-10">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Nouvel article</h1>
        </div>
        <form class="mb-5" action="index.php?action=addPost" method="post">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Titre</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label fw-bold">Auteur</label>
                <input type="text" class="form-control" id="author" name="author">
            </div>
            <div class="mb-3">
                <label for="chapo" class="form-label fw-bold">Chapô</label>
                <textarea class="tiny" id="chapo" name="chapo" rows="3"></textarea>
            </div>
            <div class="form-outline mb-4">
                <label for="tiny" class="form-label fw-bold">Corps du texte</label>
                <textarea class="tiny" name="content"></textarea>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </form>
    </div>
</main>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php'
?>