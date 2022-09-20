<?php $title = "Error"; ?>

<?php ob_start(); ?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mt-4">
                    <h1 class="display-1">OOPS !</h1>
                    <p>Une erreur est survenue : <?= $errorMessage ?></p>
                    <a href="index.php?action=homepage">
                        <i class="fas fa-arrow-left me-1"></i>
                        Retour à l'accueil.
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php');
?>