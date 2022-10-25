<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\PostRepository;

class ListAllPostsController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $posts = $postRepository->getPosts();

        $featuredPost = array_shift($posts);

        if (isset($get['page']) && !empty($get['page'])) {
            $currentPage = (int) strip_tags($get['page']);
        } else {
            $currentPage = 1;
        }

        $postsNb = count($posts);
        $perPage = 4;
        $pages = ceil($postsNb / $perPage);
        $offset = ($currentPage * $perPage) - $perPage;

        $posts = array_slice($posts, $offset, $perPage);

        $session = $globals->getSESSION('user');

        require 'templates/blog.php';
    }
}
