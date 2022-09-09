<?php
require_once('src/models/comment.php');

function viewComment(string $id)
{
    $comment = getComment($id);
    require('templates/admin/view_comment.php');
}
