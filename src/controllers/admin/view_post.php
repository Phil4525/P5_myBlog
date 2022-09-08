<?php

require_once('src/models/post.php');

function viewPost($id)
{
    $post = getPost($id);

    require('templates/admin/view_post.php');
}
