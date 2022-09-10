<?php
@session_start();
require_once('src/lib/database.php');
require_once('src/model/comment.php');

function commentSuppression($id)
{
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $comment = $commentRepository->getComment($id);

    if ($comment->author !== $_SESSION['user']['username']) {
        throw new Exception("Vous n'êtes pas autorisé à faire cette requête");
    } else {
        $postId = $comment->postId;
        $commentRepository->deleteComment($id);
        header('Location: index.php?action=post&id=' . $postId);
    }
}
