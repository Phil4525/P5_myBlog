<?php
@session_start();

require_once('src/models/comment.php');

function addComment(string $post, array $input)
{
    $author = null;
    $comment = null;

    if (!empty($_SESSION['user'])) {
        $author = $_SESSION['user']['username'];
    } else {
        throw new Exception('Connectez vous pour laisser un commentaire.');
    }
    if (!empty($input['comment'])) {
        $comment = nl2br(strip_tags($input['comment']));
    } else {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = createComment($post, $author, $comment);

    if (!$success) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    } else {
        header('Location: index.php?action=post&id=' . $post);
    }
}
