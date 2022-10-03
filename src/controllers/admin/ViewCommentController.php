<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Globals\Globals;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class ViewCommentController
{
    public function execute(string $id, ?array $input)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        if ($input !== null) {
            if (isset($input['status']) && !empty($input['status'])) {

                $status = $input['status'];

                $success = $commentRepository->updateCommentStatus($id, $status);

                if (!$success) {
                    throw new \Exception("Le commentaire n'a pu être sauvegarder");
                } else {
                    $redirect = new Redirect('index.php?action=comments');
                    $redirect->execute();
                }
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
        }

        $comment = $commentRepository->getComment($id);

        if ($comment == null) {
            throw new \Exception("Le commentaire $id n'existe pas.");
        }

        $parentComment = null;
        if ($comment->parentCommentId) {
            $parentComment = $commentRepository->getComment($comment->parentCommentId);
        } else {
            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $post = $postRepository->getPost($comment->postId);
        }

        require 'templates/admin/view_comment.php';
    }
}
