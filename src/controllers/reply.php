<?php
require_once('src/model/reply.php');

function reply(string $comment, array $input)
{
    $author = null;
    $reply = null;

    if (!empty($_SESSION['user'])) {
        $author = $_SESSION['user']['username'];
    } else {
        throw new Exception('Connectez vous pour laisser une réponse.');
    }
    if (!empty($input['reply'])) {
        $reply = nl2br(strip_tags($input['reply']));
    } else {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = createReply($comment, $author, $reply);

    if (!$success) {
        throw new Exception("Impossible d'ajouter la réponse !");
    } else {
        header('Location: index.php?action=post&id=' . $comment);
    }
}
