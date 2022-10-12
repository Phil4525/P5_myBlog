    <?php
    ob_start();
    $title = "Accueil";
    require 'templates/header.php';
    ?>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <!-- <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div> -->
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/cabin.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
                <!-- Portfolio Item 3-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/circus.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
                <!-- Portfolio Item 4-->
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/game.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
                <!-- Portfolio Item 5-->
                <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/safe.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
                <!-- Portfolio Item 6-->
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <!-- <img class="img-fluid" src="assets/img/portfolio/submarine.png" alt="..." /> -->
                        <img class="img-fluid" src="https://dummyimage.com/388x258/dee1e6/697379.jpg" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">À propos</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <!-- <div class="divider-custom-icon"><i class="fas fa-star"></i></div> -->
                <!-- <div class="divider-custom-line"></div> -->
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <p class="lead">Aliquam feugiat a nisl in vestibulum. Donec accumsan eleifend metus, non auctor ante mattis iaculis. Praesent vel ligula ante. Fusce tristique lacus nisl, at malesuada ante faucibus ac. Nulla sed posuere mauris. Praesent sit amet odio odio. Donec ut ligula vel arcu ornare luctus suscipit eget lectus. Proin a elit massa. Aenean vitae est neque. Aenean consectetur nunc vitae ornare suscipit.</p>
                </div>
                <div class="col-lg-4 me-auto">
                    <p class="lead">Pellentesque nulla erat, pretium vitae nisi condimentum, dapibus sagittis velit. Cras felis justo, iaculis eget nibh quis, porta interdum magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed blandit elementum quam, eu posuere eros dapibus sed. Nunc luctus a tellus sit amet euismod. Cras consectetur sapien vel risus lacinia porta.</p>
                </div>
            </div>
            <!-- About Section Button-->
            <div class="text-center mt-4">
                <!-- <a class="btn btn-xl btn-outline-light" href="index.php?action=viewCV"> -->
                <a class="btn btn-lg btn-outline-light" href="./assets/P_Mariou_cv_20.pdf" target="blank">
                    Curriculum Vitæ
                </a>
            </div>
        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <!-- <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div> -->
            </div>
            <!-- Contact Section Form-->
            <div class="row justify-content-center" id="contact-form">
                <div class="col-lg-8 col-xl-7">
                    <form action="index.php?action=contact" method="post">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="fullname" placeholder="Enter your name..." required />
                            <label>Nom</label>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" type="email" name="email" placeholder="name@example.com" required />
                            <label>Email</label>
                        </div>
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" type="tel" name="phone" placeholder="(123) 456-7890" />
                            <label>Telephone</label>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-4">
                            <textarea class="form-control" type="text" name="message_content" placeholder="Enter your message here..." style="height: 15rem" required></textarea>
                            <label>Message</label>
                        </div>
                        <!-- Submit Button-->
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary btn-lg w-100" type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    $content = ob_get_clean();
    require 'templates/layout.php';
    ?>