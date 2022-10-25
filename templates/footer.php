<?php

use App\Lib\Globals;

$globals = new Globals();
$session = $globals->getSESSION('user');
?>
<footer class="footer p-5 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fa-brands fa-github-alt fs-3"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter fs-4"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white" id="copyright">
    <div class="container"><small>Copyright &copy; Philippe Mariou 2022</small></div>
    <?php if (!isset($session)) { ?>
        <a href="" data-bs-toggle="modal" data-bs-target="#adminLogin"><small>Admin Zone</small></a>
    <?php } elseif ($session['role'] == 'admin') { ?>
        <a href="index.php?action=dashboard"><small>Admin Zone</small></a>
    <?php } else { ?>
        <a href="index.php#copyright"><small>Admin Zone</small></a>
    <?php } ?>
</div>

<!-- Modal login -->
<div class="modal fade" id="adminLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=adminLogin" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" placeholder="name@example.com" required />
                        <label>Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password" required />
                        <label>Mot de passe</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="#" data-bs-toggle="modal" data-bs-target="#passwordRecovery">Mot de passe oublié ?</a>
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>