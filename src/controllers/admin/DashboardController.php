<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\PostRepository;
use App\Model\Post;
use App\Repository\CommentRepository;
use App\Model\Comment;
use App\Repository\UserRepository;
use App\Model\User;
use App\Repository\ContactRepository;
use App\Model\Contact;

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

        // posts section

        $posts = $postRepository->getPosts();

        $postsNb = count($posts);

        $lastPost = new Post;
        $lastPost = $posts[0];

        $mostCommentedPost = $postRepository->getMostCommentedPost();

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

        require 'templates/admin/dashboard.php';
    }
}
