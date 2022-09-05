<?php @session_start(); ?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">myBlog()</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto text-uppercase">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=homepage">Home</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php#about">About</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php#contact">Contact</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=blog">Blog</a></li>
                <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=register">Sign up</a></li> -->
                <?php
                if (!isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="" data-bs-toggle="modal" data-bs-target="#register">Sign up</a></li>
                <?php
                } else {
                ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded">Sign up</a></li>
                <?php
                }


                if (isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=logout">Log out</a></li>
                <?php
                } else {
                ?>
                    <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=login">Log in</a></li> -->
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="" data-bs-toggle="modal" data-bs-target="#login">Log in</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal register -->

<div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=register" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="username" placeholder="Enter your user name" />
                        <label>User name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" placeholder="name@example.com" />
                        <label>Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Create a password" />
                        <label>Password</label>
                    </div>
                    <div class="mt-4 mb-0 d-grid">
                        <button class="btn btn-primary btn-block" type="submit">Send</button>
                    </div>
                </form>
                <div class="modal-footer text-center py-3">
                    <div class="small"><a href="" data-bs-toggle="modal" data-bs-target="#login">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal login -->

<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=login" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" placeholder="name@example.com" />
                        <label>Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                        <label>Password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" />
                        <label class="form-check-label">Remember Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="index.php?action=password">Forgot Password?</a>
                        <!-- <a class="btn btn-primary" href="index.html">Login</a> -->
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
                <div class="modal-footer py-3">
                    <div class="small"><a href="" data-bs-toggle="modal" data-bs-target="#register">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>