<?php

namespace App\Controllers\Admin\ViewComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;

class ViewCommentController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();

            $comment = $commentRepository->getComment($id);

            require('templates/admin/view_comment.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
