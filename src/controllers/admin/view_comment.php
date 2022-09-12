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
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $comment = $commentRepository->getComment($id);

        require('templates/admin/view_comment.php');
    }
}

function viewComment(string $id)
{
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();

    $comment = $commentRepository->getComment($id);

    require('templates/admin/view_comment.php');
}
