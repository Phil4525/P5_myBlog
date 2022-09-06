<?php
$title = "Posts";
ob_start();
require('templates/admin/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php require('templates/admin/sidebar.php') ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar" class="align-text-bottom"></span>
                        This week
                    </button>
                </div>
            </div>

            <h2>Liste des articles</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titre</th>
                            <!-- <th scope="col">Chapô</th> -->
                            <!-- <th scope="col">Contenu</th> -->
                            <th scope="col">Auteur</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Editer</th>
                            <th scope="col">Supprimer</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($posts as $post) {
                        ?>
                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['title'] ?></td>
                                <!-- <td><?= $post['chapo'] ?></td> -->
                                <!-- <td><?= $post['content'] ?></td> -->
                                <td><?= $post['author'] ?></td>
                                <td><?= $post['french_creation_date'] ?></td>
                                <td><a href="index.php?action=editPost&id=<?= $post['id'] ?>" class="fa-sharp fa-solid fa-pen"></a></td>
                                <td><a href="index.php?action=deletePost&id=<?= $post['id'] ?>" class="fa-solid fa-trash-can"></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>