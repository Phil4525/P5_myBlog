<?php

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

function post(string $id)
{
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $post = $postRepository->getPost($id);

    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $comments = $commentRepository->getCommentsByPostId($id);

    require('templates/post.php');
}
