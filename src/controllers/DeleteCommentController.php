<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\CommentRepository;

class DeleteCommentController
{
    public function execute(string $id)
    {
        $globals = new Globals();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($id);

        $session = $globals->getSESSION('user');

        if ($comment->author === $session['username']) {

            $postId = $comment->postId;

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
                // } else {
                //     header('Location: index.php?action=post&id=' . $postId);
                //     exit;
            }
            header('Location: index.php?action=post&id=' . $postId);
            exit;
        } elseif ($_SESSION['user']['role'] === 'admin') {

            $get = $globals->getGET();
            $page = $get['page'];

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
                // } else {
                //     header('Location: index.php?action=comments&page=' . $page);
                //     exit;
            }
            header('Location: index.php?action=comments&page=' . $page);
            exit;
        } else {
            throw new \Exception("Vous n'êtes pas autorisé à faire cette requête");
        }
    }
}
