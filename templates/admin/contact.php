<?php
ob_start();
$title = "Contacts";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Contacts</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) { ?>
                    <tr>
                        <td><?= $contact->id ?></td>
                        <td><?= $contact->fullname ?></td>
                        <td><?= $contact->email ?></td>
                        <td><?= $contact->phone ?></td>
                        <td><?= $contact->frenchCreationDate ?></td>
                        <td><a href="index.php?action=viewContact&id=<?= urlencode($contact->id) ?>" class="text-decoration-none fa-solid fa-eye"></a></td>
                        <td><a href="" data-bs-toggle="modal" data-bs-target="#deleteContact-<?= urlencode($contact->id) ?>" class="text-decoration-none fa-solid fa-trash-can"></a></td>
                    </tr>
                    <!-- delete user modal -->
                    <div class="modal fade" id="deleteContact-<?= $contact->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Suppression de demande de contact</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Etes-vous sûr de vouloir supprimer ?</p>
                                    <div class="d-md-flex justify-content-md-end">
                                        <a type="button" class="btn btn-danger" href="index.php?action=deleteContact&id=<?= urlencode($contact->id) ?>" role="button">Confirmer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination-->
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center my-4 pagination-sm">
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a class="page-link" href="index.php?action=contacts&page=<?= urlencode($currentPage) - 1 ?>" aria-label="Previous">
                    <span class="fa-solid fa-arrow-left" aria-hidden="true"></span>
                </a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" aria-current="page">
                    <a class="page-link" href="index.php?action=contacts&page=<?= urlencode($page) ?>"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a class="page-link" href="index.php?action=contacts&page=<?= urlencode($currentPage) + 1 ?>" aria-label="Next">
                    <span class="fa-solid fa-arrow-right" aria-hidden="true"></span>
                </a>
            </li>
        </ul>
    </nav>
</main>
<script src="js/sorting.js"></script>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php'
?>