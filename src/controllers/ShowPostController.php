<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class ShowPostController
{
    public function execute(string $id)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($id);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getCommentsWithChildrenByPostId($id);


        $globals = new Globals();
        $session = $globals->getSESSION('user');

        require 'templates/post.php';
    }
}
