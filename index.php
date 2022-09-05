<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/blog.php');
require_once('src/controllers/post.php');
require_once('src/controllers/admin.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/update_comment.php');
require_once('src/controllers/reply.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');
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
            if (isset($_SESSION['user'])) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $id = $_GET['id'];

                    addComment($id, $_POST);
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            } else {
                throw new Exception('Vous devez être connecté pour laisser un commentaire');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                modifyComment($id, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'reply') {
            if (isset($_SESSION['user'])) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $id = $_GET['id'];

                    reply($id, $_POST);
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            } else {
                throw new Exception('Vous devez être connecté pour laisser une reponse');
            }
        } elseif ($_GET['action'] === 'login') {

            login($_POST);
        } elseif ($_GET['action'] === 'logout') {

            logout();
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
