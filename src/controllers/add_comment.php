<?php

namespace App\Controllers\AddComment;

@session_start();

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;

class AddCommentController
{
    public function execute(string $postId, array $input)
    {
        $author = null;
        $comment = null;

        if (!empty($_SESSION['user'])) {
            $author = $_SESSION['user']['username'];
        } else {
            throw new \Exception('Connectez vous pour laisser un commentaire.');
        }

        if (!empty($input['comment'])) {
            $comment = nl2br(strip_tags($input['comment']));
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($postId, $author, $comment);

        if (!$success) {
            throw new \Exception("Impossible d'ajouter le commentaire !");
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
}

// function addComment(string $postId, array $input)
// {
//     $author = null;
//     $comment = null;

//     if (!empty($_SESSION['user'])) {
//         $author = $_SESSION['user']['username'];
//     } else {
//         throw new Exception('Connectez vous pour laisser un commentaire.');
//     }

//     if (!empty($input['comment'])) {
//         $comment = nl2br(strip_tags($input['comment']));
//     } else {
//         throw new Exception('Les données du formulaire sont invalides.');
//     }

//     $commentRepository = new CommentRepository();
//     $commentRepository->connection = new DatabaseConnection();
//     $success = $commentRepository->createComment($postId, $author, $comment);

//     if (!$success) {
//         throw new Exception("Impossible d'ajouter le commentaire !");
//     } else {
//         header('Location: index.php?action=post&id=' . $postId);
//     }
// }
