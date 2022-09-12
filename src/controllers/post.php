<?php

namespace App\Controllers\Post;

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;
use App\Model\Comment\CommentRepository;

// function post(string $id)
// {
//     $postRepository = new PostRepository();
//     $postRepository->connection = new DatabaseConnection();
//     $post = $postRepository->getPost($id);

//     $commentRepository = new CommentRepository();
//     $commentRepository->connection = new DatabaseConnection();
//     $comments = $commentRepository->getCommentsByPostId($id);

//     require('templates/post.php');
// }

class PostController
{
    public function execute(string $id)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($id);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getCommentsByPostId($id);

        require('templates/post.php');
    }
}
