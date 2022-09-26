<?php

namespace App\Controllers\Admin\ViewPost;

require_once('src/lib/DatabaseConnection.php');
// require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Post\PostRepository;

class ViewPostController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $post = $postRepository->getPost($id);

            require('templates/admin/view_post.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}