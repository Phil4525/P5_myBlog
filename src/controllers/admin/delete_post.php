<?php

namespace App\Controllers\Admin\DeletePost;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;

class DeletePostController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $success = $postRepository->deletePost($id);

            if (!$success) {
                throw new \Exception("L'article n'a pu être supprimé.");
            } else {
                header('Location: index.php?action=posts');
            }
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
