<?php

namespace App\Controllers\Admin\ViewComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;

class ViewCommentController
{
    // public function execute(string $id)
    // {
    //     if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

    //         $commentRepository = new CommentRepository();
    //         $commentRepository->connection = new DatabaseConnection();

    //         $comment = $commentRepository->getComment($id);

    //         require('templates/admin/view_comment.php');
    //     } else {
    //         throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
    //     }
    // }

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
                    }
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
            }

            $comment = $commentRepository->getComment($id);

            if ($comment == null) {
                throw new \Exception("Le commentaire $id n'existe pas.");
            }

            require('templates/admin/view_comment.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
