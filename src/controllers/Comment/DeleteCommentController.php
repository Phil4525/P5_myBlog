<?php

namespace App\Controllers\Comment;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Lib\Globals;
use App\Repository\CommentRepository;

class DeleteCommentController
{
    public function execute(string $id)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($id);

        if ($comment->author == $session['username']) {

            $postId = $comment->postId;
            $parentCommentId = $comment->parentCommentId;

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
            }

            $redirect = new Redirect('index.php?action=post&id=' . $postId . '#' . $parentCommentId);
            $redirect->execute();
        } elseif ($session['role'] === 'admin') {

            $page = $globals->getGET('page');

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
            }

            $redirect = new Redirect('index.php?action=comments&page=' . $page);
            $redirect->execute();
        } else {
            throw new \Exception("Vous n'êtes pas autorisé à faire cette requête");
        }
    }
}
