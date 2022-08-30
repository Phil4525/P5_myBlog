<?php

require_once('src/model.php');

function blog()
{
    $posts = getPosts();

    $featuredPost = array_shift($posts);

    require('templates/blog.php');
}
