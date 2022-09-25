<?php

namespace App\Controllers\AddComment;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Comment\CommentRepository;

class AddCommentController
{
    public function execute(string $postId, ?string $parentCommentId, array $input)
    {
        $author = null;
        $comment = null;

        if (!empty($_SESSION['user'])) {
            $author = $_SESSION['user']['username'];
        } else {
            throw new \Exception('Vous devez être connecté pour laisser un commentaire.');
        }

        if (!empty($input['comment'])) {
            $comment = nl2br(strip_tags($input['comment']));
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($postId, $parentCommentId, $author, $comment);

        if (!$success) {
            throw new \Exception("Impossible d'ajouter le commentaire !");
        } else {
            header('Location: index.php?action=post&id=' . $postId);
            die;
        }
    }
}
