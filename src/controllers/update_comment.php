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
        $success = updateComment($id, $_SESSION['user']['username'], $comment);

        if (!$success) {
            throw new Exception('Impossible de modifier le commentaire !');
        } else {
            $postId = getComment($id);
            header('Location: index.php?action=post&id=' . $postId['post_id'] . '#' . $id);
        }
    }

    // Otherwise, it displays the form.
    $oldComment = getComment($id);
    if ($oldComment === null) {
        throw new Exception("Le commentaire $id n'existe pas.");
    }
}
