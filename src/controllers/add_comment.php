<?php
require_once('src/models/comment.php');

function addComment(string $post, array $input)
{
    $author = null;
    $comment = null;
    if (!empty($input['author']) && !empty($input['comment'])) {
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        // die('Les données du formulaires sont invalides.');
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = createComment($post, $author, $comment);
    if (!$success) {
        // die("impossible d'ajouter le commentaire!");
        throw new Exception("Impossible d'ajouter le commentaire !");
    } else {
        header('Location: index.php?action=post&id=' . $post);
    }
}
