<?php

require_once('src/model.php');
require_once('src/models/post.php');
require_once('src/models/comment.php');
// require_once('src/models/reply.php');

function post(string $id)
{
    $post = getPost($id);

    $comments = getComments($id);

    // foreach ($comments as $comment) {
    //     $replies[] = getReplies($comment['id']);
    // }

    require('templates/post.php');
}
