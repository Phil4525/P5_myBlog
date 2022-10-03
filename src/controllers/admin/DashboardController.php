<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;

class DashboardController
{
    public function execute()
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $contactRepository = new ContactRepository();
        $contactRepository->connection = new DatabaseConnection();

        $posts = $postRepository->getPosts();

        $postsNb = count($posts);

        $lastPost = $posts[0];

        $mostCommentedPost = $postRepository->getMostCommentedPost();

        $comments = $commentRepository->getComments();

        $commentsNb = count($comments);

        $lastComment = $comments[0];

        $waitingComments = count($commentRepository->getCommentsWaitingForValidation());

        $users = $userRepository->getUsers();

        $usersNb = count($users);

        $lastUser = $users[0];

        $mostActiveUser = $userRepository->getMostActiveUser();

        $contacts  = $contactRepository->getContacts();

        $contactsNb = count($contacts);

        $lastContact = $contacts[0];

        require 'templates/admin/dashboard.php';
    }
}
