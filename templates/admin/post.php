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
                <h1 class="h2">Liste des articles</h1>
            </div>

            <!-- <h2>Liste des articles</h2> -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <a class="btn btn-primary" href="index.php?action=newPost" role="button">Créer un nouvel article</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Date de mise à jour</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($posts as $post) {
                        ?>
                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['author'] ?></td>
                                <td><?= $post['french_creation_date'] ?></td>
                                <td><a href="index.php?action=viewPost&id=<?= $post['id'] ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                                <td><a href="index.php?action=editPost&id=<?= $post['id'] ?>" class="text-decoration-none fa-sharp fa-solid fa-pen"></a></td>
                                <td><a href="index.php?action=deletePost&id=<?= $post['id'] ?>" class="text-decoration-none fa-solid fa-trash-can"></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center my-4 pagination-sm">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminPosts&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                            <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                            <a class="page-link" href="index.php?action=adminPosts&page=<?= $page ?>"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a class="page-link" href="index.php?action=adminPosts&page=<?= $currentPage + 1 ?>" aria-label="Next">
                            <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>
<?php
$content = ob_get_clean();
require('templates/admin/layout.php')
?>