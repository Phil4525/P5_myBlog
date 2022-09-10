<?php

require_once('src/model/post.php');

function viewPost($id)
{
    $post = getPost($id);

    require('templates/admin/view_post.php');
}
