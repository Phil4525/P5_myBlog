<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\PostRepository;

class ViewPostController
{
    public function execute(string $id)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (isset($session) && $session['role'] == 'admin') {

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $post = $postRepository->getPost($id);

            require 'templates/admin/view_post.php';
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
