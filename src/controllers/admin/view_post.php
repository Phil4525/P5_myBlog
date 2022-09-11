<?php
require_once('src/lib/database.php');
require_once('src/model/post.php');

function viewPost($id)
{
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $post = $postRepository->getPost($id);

    require('templates/admin/view_post.php');
}
