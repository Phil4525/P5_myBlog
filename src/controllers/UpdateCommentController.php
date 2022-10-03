<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Repository\CommentRepository;

class UpdateCommentController
{
    public function execute(string $id, ?array $input)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        // It handles the form submission when there is an input.
        if ($input !== null) {
            $commentContent = null;
            if (!empty($input['comment'])) {
                $commentContent = nl2br(strip_tags($input['comment']));
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $success = $commentRepository->updateComment($id, $commentContent);

            if (!$success) {
                throw new \Exception('Impossible de modifier le commentaire !');
            } else {
                $newComment = $commentRepository->getComment($id);

                $redirect = new Redirect('index.php?action=post&id=' . $newComment->postId . '#' . $id);
                $redirect->execute();
            }
        }

        // Otherwise, it displays the form.
        $comment = $commentRepository->getComment($id);

        if ($comment === null) {
            throw new \Exception("Le commentaire $id n'existe pas.");
        }
    }
}
