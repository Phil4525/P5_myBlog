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
                <h1 class="h2">Nouvel article</h1>
            </div>

            <form action="#" method="post">
                <div class="form-floating form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" />
                    <label class="form-label" for="title">Title</label>
                </div>

            </form>

        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>