<header class="masthead bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <?php if (!isset($session)) { ?>
                <h1 class="fw-bolder">Welcome to myBlog()</h1>
            <?php } else { ?>
                <h1 class="fw-bolder">Welcome <?= $session['username'] ?> !</h1>
            <?php } ?>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>