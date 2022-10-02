<?php
$title = "Tableau de bord";
ob_start();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-newspaper me-1"></i>
                    Articles
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre d'articles publiés : <?= strip_tags($postsNb) ?></li>
                        <li>Date du dernier article publié : le <?= strip_tags($lastPost->frenchCreationDate) ?></li>
                        <li>Article le plus commenté : <?= strip_tags($mostCommentedPost['title']) ?> (<?= strip_tags($mostCommentedPost['comments_number']) ?> comm.)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-comment me-1"></i>
                    Commentaires
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre de commentaires : <?= strip_tags($commentsNb) ?></li>
                        <li>Dernier commentaire : <?= strip_tags($lastComment->author) ?> le <?= strip_tags($lastComment->frenchCreationDate) ?></li>
                        <li>Nombre de commentaires en attente de validation : <?= strip_tags($waitingComments) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users me-1"></i>
                    Utilisateurs
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre d'utilisateurs inscrits : <?= strip_tags($usersNb) ?></li>
                        <li>Dernière inscription : <?= strip_tags($lastUser->username) ?> le <?= strip_tags($lastUser->frenchCreationDate) ?></li>
                        <li>Utilisateur le plus actif : <?= strip_tags($mostActiveUser['username']) ?> (<?= strip_tags($mostActiveUser['comments_number']) ?> comm.).</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-envelope me-1"></i>
                    Contacts
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre de demandes de contact : <?= strip_tags($contactsNb) ?></li>
                        <li>Dernière demande de contact : <?= strip_tags($lastContact->fullname) ?> le <?= strip_tags($lastContact->frenchCreationDate) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
$content = ob_get_clean();
require 'templates/admin/layout.php';
?>