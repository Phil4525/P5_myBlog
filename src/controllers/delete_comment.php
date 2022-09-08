<?php
@session_start();
require_once('src/models/comment.php');

function commentSuppression($id)
{
    $comment = getComment($id);

    if ($comment['author'] !== $_SESSION['user']['username']) {
        throw new Exception("Vous n'êtes pas autorisé à faire cette requête");
    } else {
        $postId = $comment['post_id'];
        deleteComment($id);
        header('Location: index.php?action=post&id=' . $postId);
    }
}
