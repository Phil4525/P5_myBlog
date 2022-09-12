<?php

namespace App\Controllers\DeleteComment;

@session_start();

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;

class DeleteCommentController
{
    public function execute(string $id)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($id);

        if ($comment->author !== $_SESSION['user']['username']) {
            throw new \Exception("Vous n'êtes pas autorisé à faire cette requête");
        } else {
            $postId = $comment->postId;

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
            } else {
                header('Location: index.php?action=post&id=' . $postId);
            }
        }
    }
}

// function commentSuppression($id)
// {
//     $commentRepository = new CommentRepository();
//     $commentRepository->connection = new DatabaseConnection();
//     $comment = $commentRepository->getComment($id);

//     if ($comment->author !== $_SESSION['user']['username']) {
//         throw new Exception("Vous n'êtes pas autorisé à faire cette requête");
//     } else {
//         $postId = $comment->postId;

//         $commentRepository->deleteComment($id);

//         header('Location: index.php?action=post&id=' . $postId);
//     }
// }
