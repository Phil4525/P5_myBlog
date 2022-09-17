<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/blog.php');
require_once('src/controllers/post.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/update_comment.php');
require_once('src/controllers/delete_comment.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');
require_once('src/controllers/signup.php');
require_once('src/controllers/password_recovery.php');
require_once('src/controllers/contact.php');
require_once('src/controllers/admin/admin_login.php');
require_once('src/controllers/admin/dashboard.php');
require_once('src/controllers/admin/posts.php');
require_once('src/controllers/admin/new_post.php');
require_once('src/controllers/admin/add_post.php');
require_once('src/controllers/admin/view_post.php');
require_once('src/controllers/admin/update_post.php');
require_once('src/controllers/admin/delete_post.php');
require_once('src/controllers/admin/comments.php');
require_once('src/controllers/admin/view_comment.php');
require_once('src/controllers/admin/users.php');
require_once('src/controllers/admin/view_user.php');
require_once('src/controllers/admin/delete_user.php');
require_once('src/controllers/admin/contact.php');
require_once('src/controllers/admin/view_contact.php');
require_once('src/controllers/admin/delete_contact.php');

use App\Controllers\Homepage\HomepageController;
use App\Controllers\Blog\BlogController;
use App\Controllers\Post\PostController;
use App\Controllers\AddComment\AddCommentController;
use App\Controllers\UpdateComment\UpdateCommentController;
use App\Controllers\DeleteComment\DeleteCommentController;
use App\Controllers\Login\LoginController;
use App\Controllers\Logout\LogoutController;
use App\Controllers\Signup\SignupController;
use App\Controllers\ResetPassword\PasswordRecoveryController;
use App\Controllers\Contact\ContactController;
use App\Controllers\Admin\AdminLogin\AdminLoginController;
use App\Controllers\Admin\Dashboard\DashboardController;
use App\Controllers\Admin\Posts\PostsController;
use App\Controllers\Admin\NewPost\NewPostController;
use App\Controllers\Admin\AddPost\AddPostController;
use App\Controllers\Admin\ViewPost\ViewPostController;
use App\Controllers\Admin\UpdatePost\UpdatePostController;
use App\Controllers\Admin\DeletePost\DeletePostController;
use App\Controllers\Admin\Comments\CommentsController;
use App\Controllers\Admin\ViewComment\ViewCommentController;
use App\Controllers\Admin\Users\UsersController;
use App\Controllers\Admin\ViewUser\ViewUserController;
use App\Controllers\Admin\DeleteUser\DeleteUserController;
use App\Controllers\Admin\Contacts\ContactsController;
use App\Controllers\Admin\ViewContact\viewContactController;
use App\Controllers\Admin\DeleteContact\DeleteContactController;

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

                (new AddCommentController())->execute($id, $_POST);
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
        } elseif ($_GET['action'] === 'contact') {

            (new ContactController())->execute($_POST);
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

                (new ViewCommentController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant de commentaire envoyé.");
            }
        } elseif ($_GET['action'] === 'users') {

            (new UsersController())->execute();
        } elseif ($_GET['action'] === 'viewUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                (new ViewUserController())->execute($id);
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
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new HomepageController())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}
