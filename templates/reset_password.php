<?php $title = "Reset password"; ?>
<?php ob_start(); ?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Reset Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Enter your new password.</div>
                                <form action="index.php?action=resetPassword&key=<?= $email ?>&reset=<?= $password ?>" method="post">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" type="hidden" value="<?= $email ?>" />
                                        <input class="form-control" type="password" name="new_password" placeholder="Create a password" />
                                        <label>Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="index.php?action=login">Return to login</a>
                                        <button class="btn btn-primary" type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="index.php?action=signup">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout.php' ?>