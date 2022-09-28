<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\CommentRepository;

class AddCommentController
{
    public function execute(string $postId, ?string $parentCommentId, array $input)
    {
        $author = null;
        $comment = null;

        $globals = new Globals();
        $session = $globals->getSESSION('user');

        // if (!empty($session)) {
        //     $author = $session['username'];
        // } else {
        //     throw new \Exception('Vous devez être connecté pour laisser un commentaire.');
        // }
        if (empty($session)) {
            throw new \Exception('Vous devez être connecté pour laisser un commentaire.');
        }

        $author = $session['username'];

        // if (!empty($input['comment'])) {
        //     $comment = nl2br(strip_tags($input['comment']));
        // } else {
        //     throw new \Exception('Les données du formulaire sont invalides.');
        // }

        if (empty($input['comment'])) {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $comment = nl2br(strip_tags($input['comment']));

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($postId, $parentCommentId, $author, $comment);

        if (!$success) {
            throw new \Exception("Impossible d'ajouter le commentaire !");
        }
        // } else {
        header('Location: index.php?action=post&id=' . $postId);
        exit;
        // }
    }
}
