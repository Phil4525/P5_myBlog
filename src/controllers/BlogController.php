<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Repository\PostRepository;

class BlogController
{
    public function execute()
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $posts = $postRepository->getPosts();

        $featuredPost = array_shift($posts);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $postsNb = count($posts);
        $perPage = 4;
        $pages = ceil($postsNb / $perPage);
        $offset = ($currentPage * $perPage) - $perPage;

        $posts = array_slice($posts, $offset, $perPage);

        require 'templates/blog.php';
    }
}
