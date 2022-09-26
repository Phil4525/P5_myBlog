<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\HomepageController;
use App\Controllers\BlogController;
use App\Controllers\PostController;
use App\Controllers\AddCommentController;
use App\Controllers\UpdateCommentController;
use App\Controllers\DeleteCommentController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\SignupController;
use App\Controllers\PasswordRecoveryController;
use App\Controllers\ResetPasswordController;
use App\Controllers\ContactController;
use App\Controllers\SearchController;
use App\Controllers\Admin\AdminLoginController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\PostsController;
use App\Controllers\Admin\NewPostController;
use App\Controllers\Admin\AddPostController;
use App\Controllers\Admin\ViewPostController;
use App\Controllers\Admin\UpdatePostController;
use App\Controllers\Admin\DeletePostController;
use App\Controllers\Admin\CommentsController;
use App\Controllers\Admin\ViewCommentController;
use App\Controllers\Admin\UsersController;
use App\Controllers\Admin\ViewUserController;
use App\Controllers\Admin\DeleteUserController;
use App\Controllers\Admin\ContactsController;
use App\Controllers\Admin\viewContactController;
use App\Controllers\Admin\DeleteContactController;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'homepage') {

            (new HomepageController())->execute();
        } elseif ($_GET['action'] === 'blog') {

            (new BlogController())->execute();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new PostController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                $parentCommentId = null;
                if (isset($_GET['parentCommentId']) && $_GET['parentCommentId'] > 0) {
                    $parentCommentId = strip_tags($_GET['parentCommentId']);
                }

                (new AddCommentController())->execute($id, $parentCommentId, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                (new UpdateCommentController())->execute($id, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new DeleteCommentController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($_GET['action'] === 'login') {

            (new LoginController())->execute($_POST);
        } elseif ($_GET['action'] === 'logout') {

            (new LogoutController())->execute();
        } elseif ($_GET['action'] === 'signup') {

            (new SignupController())->execute($_POST);
        } elseif ($_GET['action'] === 'passwordRecovery') {

            (new PasswordRecoveryController())->execute($_POST);
        } elseif ($_GET['action'] === 'resetPassword') {
            if (isset($_GET['key']) && isset($_GET['reset'])) {
                $email = $_GET['key'];
                $password = $_GET['reset'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new ResetPasswordController())->execute($email, $password, $input);
            } else {
                throw new Exception("Aucune information d'utilisateur envoyé.");
            }
        } elseif ($_GET['action'] === 'contact') {

            (new ContactController())->execute($_POST);
        } elseif ($_GET['action'] === 'search') {

            (new SearchController())->execute($_POST);
        } elseif ($_GET['action'] === 'adminLogin') {

            (new AdminLoginController())->execute($_POST);
        } elseif ($_GET['action'] === 'dashboard') {

            (new DashboardController())->execute();
        } elseif ($_GET['action'] === 'posts') {

            (new PostsController())->execute();
        } elseif ($_GET['action'] === 'newPost') {

            (new NewPostController())->execute();
        } elseif ($_GET['action'] === 'addPost') {

            (new AddPostController())->execute($_POST);
        } elseif ($_GET['action'] === 'viewPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new ViewPostController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé.");
            }
        } elseif ($_GET['action'] === 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                (new UpdatePostController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé.");
            }
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new DeletePostController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($_GET['action'] === 'comments') {

            (new CommentsController())->execute();
        } elseif ($_GET['action'] === 'viewComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new ViewCommentController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant de commentaire envoyé.");
            }
        } elseif ($_GET['action'] === 'users') {

            (new UsersController())->execute();
        } elseif ($_GET['action'] === 'viewUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new ViewUserController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($_GET['action'] === 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new DeleteUserController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($_GET['action'] === 'contacts') {

            (new ContactsController())->execute();
        } elseif ($_GET['action'] === 'viewContact') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new viewContactController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant de message envoyé.");
            }
        } elseif ($_GET['action'] === 'deleteContact') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new DeleteContactController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($_GET['action'] === 'adminSearch') {

            (new SearchController())->execute($_POST);
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new HomepageController())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require 'templates/error.php';
}
