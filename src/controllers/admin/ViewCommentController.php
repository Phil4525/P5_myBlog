<?php

namespace App\Controllers\Admin\ViewComment;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Comment\CommentRepository;
use App\Repository\Post\PostRepository;

class ViewCommentController
{
    public function execute(string $id, ?array $input)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();

            if ($input !== null) {
                if (isset($input['status']) && !empty($input['status'])) {

                    $status = $input['status'];

                    $success = $commentRepository->updateCommentStatus($id, $status);

                    if (!$success) {
                        throw new \Exception("Le commentaire n'a pu être sauvegarder");
                    } else {
                        header('Location: index.php?action=comments');
                        exit;
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

            require('templates/admin/view_comment.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
