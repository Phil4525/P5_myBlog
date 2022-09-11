<?php
require_once('src/lib/database.php');
require_once('src/model/comment.php');

function viewComment(string $id)
{
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();

    $comment = $commentRepository->getComment($id);

    require('templates/admin/view_comment.php');
}
