<?php

require_once('src/model.php');

function blog()
{

    $posts = getPosts();

    require('templates/blog.php');
}
