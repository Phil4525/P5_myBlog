<?php

use App\Lib\Globals;

$globals = new Globals();
$session = $globals->getSESSION('user');
?>
<nav class="navbar navbar-expand-lg bg-secondary fixed-top p-1" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">myBlog()</a>
        <button class="navbar-toggler text-uppercase font-weight-bold text-white rounded p-1 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto text-uppercase">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="index.php?action=homepage">Accueil</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="index.php#contact">Contact</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="index.php?action=blog">Blog</a></li>

                <!-- login/out button -->
                <?php if (isset($session)) { ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="index.php?action=logout">Déconnexion</a></li>
                <?php } else { ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="" data-bs-toggle="modal" data-bs-target="#login">Connexion</a></li>
                <?php } ?>

                <li class="nav-item  mx-0 mx-lg-1 dropstart">
                    <a class="nav-link py-3 px-0 px-lg-3" href="" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <div class="dropdown-menu p-0 mt-2" aria-labelledby="dropdown05">
                        <form action="index.php?action=search" method="post">
                            <input type="text" class="form-control border-0" name="keyword" placeholder="Rechercher...">
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal login -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=login" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" placeholder="name@example.com" required />
                        <label>Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password" required />
                        <label>Mot de passe</label>
                    </div>
                    <!-- <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" />
                        <label class="form-check-label">Remember Password</label>
                    </div> -->
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-4">
                        <a class="small" href="" data-bs-toggle="modal" data-bs-target="#passwordRecovery">Mot de passe oublié ?</a>
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
                <div class="modal-footer py-3">
                    <div class="small"><a href="" data-bs-toggle="modal" data-bs-target="#signup">Pas de compte ? Créez en un !</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal register -->
<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=signup" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="username" placeholder="Enter your user name" required />
                        <label>Nom/Pseudonyme</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" placeholder="name@example.com" required />
                        <label>Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Create a password" required />
                        <label>Mot de passe</label>
                    </div>
                    <div class="d-md-flex justify-content-md-end mt-4 mb-4">
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
                <div class="modal-footer text-center py-3">
                    <div class="small"><a href="" data-bs-toggle="modal" data-bs-target="#login">Vous avez un compte ? Connectez vous</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal password recovery -->
<div class="modal fade" id="passwordRecovery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Récupération de mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">Entrez votre addresse mail et il vous sera envoyé un lien pour réinitialiser votre mot de passe.</div>
                <form action="index.php?action=passwordRecovery" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" type="email" placeholder="name@example.com" required />
                        <label for="inputEmail">Email</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="" data-bs-toggle="modal" data-bs-target="#login">Retour à la page de connexion</a>
                        <button class="btn btn-primary" type="submit">Réinitialiser</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer text-center py-3">
                <div class="small"><a href="" data-bs-toggle="modal" data-bs-target="#signup">Pas de compte ? Créez en un !</a></div>
            </div>
        </div>
    </div>
</div>