<?php

namespace App\Controllers\UpdateComment;

@session_start();

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;

class UpdateCommentController
{
    public function execute(string $id, ?array $input)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        // It handles the form submission when there is an input.
        if ($input !== null) {
            $comment = null;
            if (!empty($input['comment'])) {
                $comment = nl2br(strip_tags($input['comment']));
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $success = $commentRepository->updateComment($id, $comment);

            if (!$success) {
                throw new \Exception('Impossible de modifier le commentaire !');
            } else {
                $newComment = $commentRepository->getComment($id);
                header('Location: index.php?action=post&id=' . $newComment->postId . '#' . $id);
            }
        }

        // Otherwise, it displays the form.
        $comment = $commentRepository->getComment($id);

        if ($comment === null) {
            throw new \Exception("Le commentaire $id n'existe pas.");
        }
    }
}

// function modifyComment(string $id, ?array $input)
// {
//     $commentRepository = new CommentRepository();

//     // It handles the form submission when there is an input.
//     if ($input !== null) {
//         $comment = null;
//         if (!empty($input['comment'])) {
//             $comment = nl2br(strip_tags($input['comment']));
//         } else {
//             throw new Exception('Les données du formulaire sont invalides.');
//         }

//         $commentRepository->connection = new DatabaseConnection();
//         $success = $commentRepository->updateComment($id, $comment);

//         if (!$success) {
//             throw new Exception('Impossible de modifier le commentaire !');
//         } else {
//             $newComment = $commentRepository->getComment($id);
//             header('Location: index.php?action=post&id=' . $newComment->postId . '#' . $id);
//         }
//     }

//     // Otherwise, it displays the form.
//     $comment = $commentRepository->getComment($id);

//     if ($comment === null) {
//         throw new Exception("Le commentaire $id n'existe pas.");
//     }
// }
