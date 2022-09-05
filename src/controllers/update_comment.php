<?php
@session_start();

require_once('src/models/comment.php');

function modifyComment(string $id, ?array $input)
{
    // It handles the form submission when there is an input.
    if ($input !== null) {
        $comment = null;
        if (!empty($input['comment'])) {
            $comment = nl2br(strip_tags($input['comment']));
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }
        // die($id);
        $success = updateComment($id, $comment);

        if (!$success) {
            throw new Exception('Impossible de modifier le commentaire !');
        } else {
            $newComment = getComment($id);
            header('Location: index.php?action=post&id=' . $newComment['post_id'] . '#' . $id);
        }
    }

    // Otherwise, it displays the form.
    $comment = getComment($id);
    if ($comment === null) {
        throw new Exception("Le commentaire $id n'existe pas.");
    }

    // require('templates/post.php');
}
