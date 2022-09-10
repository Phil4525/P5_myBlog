<?php
require_once('src/model/comment.php');

function viewComment(string $id)
{
    $comment = getComment($id);
    require('templates/admin/view_comment.php');
}
