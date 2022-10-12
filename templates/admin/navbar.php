<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="index.php">myBlog()</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <form class="w-100" action="index.php?action=adminSearch" method="post">
        <input class="form-control form-control-dark rounded-0 border-0" name="keyword" type="text" placeholder="Rechercher" aria-label="Search">
    </form>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="index.php?action=logout">Déconnexion</a>
        </div>
    </div>
</header>