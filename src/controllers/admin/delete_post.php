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
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $success = $postRepository->deletePost($id);

        if (!$success) {
            throw new \Exception("L'article n'a pu être supprimé.");
        } else {
            header('Location: index.php?action=posts');
        }
    }
}
