<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/blog.php');
require_once('src/controllers/post.php');
require_once('src/controllers/admin.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/login.php');
require_once('src/controllers/register.php');
require_once('src/controllers/password.php');
require_once('src/controllers/contact.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'homepage') {

            homepage();
        } elseif ($_GET['action'] === 'blog') {

            blog();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                post($id);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'admin') {

            admin();
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                addComment($id, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'login') {

            login($_POST);
        } elseif ($_GET['action'] === 'register') {

            register($_POST);
        } elseif ($_GET['action'] === 'password') {

            password();
        } elseif ($_GET['action'] === 'contact') {

            contact($_POST);
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        homepage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}
