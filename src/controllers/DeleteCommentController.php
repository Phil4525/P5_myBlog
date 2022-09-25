<?php

namespace App\Controllers\DeleteComment;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Comment\CommentRepository;

class DeleteCommentController
{
    public function execute(string $id)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($id);

        if ($comment->author === $_SESSION['user']['username']) {

            $postId = $comment->postId;

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
            } else {
                header('Location: index.php?action=post&id=' . $postId);
                die;
            }
        } elseif ($_SESSION['user']['role'] === 'admin') {

            $page = $_GET['page'];

            $success = $commentRepository->deleteComment($id);

            if (!$success) {
                throw new \Exception("le commentaire n'a pu être supprimer");
            } else {
                header('Location: index.php?action=comments&page=' . $page);
                die;
            }
        } else {
            throw new \Exception("Vous n'êtes pas autorisé à faire cette requête");
        }
    }
}
