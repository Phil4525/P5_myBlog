<?php

namespace App\Controllers\Admin\ViewPost;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;

class ViewPostController
{
    public function execute(string $id)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($id);

        require('templates/admin/view_post.php');
    }
}

// function viewPost($id)
// {
//     $postRepository = new PostRepository();
//     $postRepository->connection = new DatabaseConnection();
//     $post = $postRepository->getPost($id);

//     require('templates/admin/view_post.php');
// }
