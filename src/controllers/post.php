<?php

require_once('src/model.php');
require_once('src/models/post.php');
require_once('src/models/comment.php');

function post(string $id)
{
    $post = getPost($id);
    $comments = getComments($id);

    require('templates/post.php');
}
