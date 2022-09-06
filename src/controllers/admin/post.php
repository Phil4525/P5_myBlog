<?php
require_once('src/models/post.php');

function adminPost()
{
    $posts = getPosts();

    require('templates/admin/post.php');
}
