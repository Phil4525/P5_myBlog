<?php

namespace App\Controllers\Post;

require_once('src/lib/DatabaseConnection.php');
require_once('src/repository/PostRepository.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Post\PostRepository;
use App\Repository\Comment\CommentRepository;

class PostController
{
    public function execute(string $id)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($id);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getCommentsWithChildrenByPostId($id);

        require('templates/post.php');
    }
}
