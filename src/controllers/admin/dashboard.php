<?php

namespace App\Controllers\Admin\Dashboard;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;
use App\Model\Post\Post;
use App\Model\Comment\CommentRepository;
use App\Model\Comment\Comment;
use App\Model\User\UserRepository;
use App\Model\User\User;
use App\Model\Contact\ContactRepository;
use App\Model\Contact\Contact;

class DashboardController
{
    public function execute()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();

            // posts section

            $posts = $postRepository->getPosts();

            $postsNb = count($posts);

            $lastPost = new Post;
            $lastPost = $posts[0];

            $mostCommentedPost = $postRepository->getPostByCommentsNumber();

            // comments section

            $comments = $commentRepository->getComments();

            $commentsNb = count($comments);

            $lastComment = new Comment;
            $lastComment = $comments[0];

            $waitingComments = count($commentRepository->getCommentsWaitingForValidation());

            // users section

            $users = $userRepository->getUsers();

            $usersNb = count($users);

            $lastUser = new User;
            $lastUser = $users[0];

            $mostActiveUser = $userRepository->getMostActiveUser();

            // contacts section

            $contacts  = $contactRepository->getContacts();

            $contactsNb = count($contacts);

            $lastContact = new Contact;
            $lastContact = $contacts[0];

            require('templates/admin/dashboard.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
