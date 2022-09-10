<?php
require_once('src/model/post.php');

function postSuppression(string $id)
{
    deletePost($id);
    header('Location: index.php?action=adminPosts');
}
