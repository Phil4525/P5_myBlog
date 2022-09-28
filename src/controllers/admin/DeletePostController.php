<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use aPP\Globals\Globals;
use App\Repository\PostRepository;

class DeletePostController
{
    public function execute(string $id)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $success = $postRepository->deletePost($id);

        if (!$success) {
            throw new \Exception("L'article n'a pu être supprimé.");
        } else {
            header('Location: index.php?action=posts');
            exit;
        }
        // } else {
        //     throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        // }
    }
}
