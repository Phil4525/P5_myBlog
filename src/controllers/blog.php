<?php

require_once('src/model.php');

function blog()
{

    $posts = getPosts();

    $featuredPost = $posts[0];
    $olderPosts = array_shift($posts);

    require('templates/blog.php');
}
