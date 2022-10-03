<?php
ob_start();
$title = "Tableau de bord";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
    </div>
    <div class="row">
        <div class="col-xl-6 pb-4">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <i class="fa-solid fa-newspaper me-1"></i>
                    Articles
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre d'articles publiés : <?= $postsNb ?></li>
                        <li>Date du dernier article publié : le <?= $lastPost->frenchCreationDate ?></li>
                        <li>Article le plus commenté : <?= $mostCommentedPost['title'] ?> (<?= $mostCommentedPost['comments_number'] ?> comm.)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 pb-4">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <i class="fa-solid fa-comment me-1"></i>
                    Commentaires
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre de commentaires : <?= $commentsNb ?></li>
                        <li>Dernier commentaire : <?= $lastComment->author ?> le <?= $lastComment->frenchCreationDate ?></li>
                        <li>Nombre de commentaires en attente de validation : <?= $waitingComments ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 pb-4">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <i class="fa-solid fa-users me-1"></i>
                    Utilisateurs
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre d'utilisateurs inscrits : <?= $usersNb ?></li>
                        <li>Dernière inscription : <?= $lastUser->username ?> le <?= $lastUser->frenchCreationDate ?></li>
                        <li>Utilisateur le plus actif : <?= $mostActiveUser['username'] ?> (<?= $mostActiveUser['comments_number'] ?> comm.).</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 pb-4">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <i class="fa-solid fa-envelope me-1"></i>
                    Contacts
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nombre de demandes de contact : <?= $contactsNb ?></li>
                        <li>Dernière demande de contact : <?= $lastContact->fullname ?> le <?= $lastContact->frenchCreationDate ?></li>
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