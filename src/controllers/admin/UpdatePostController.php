<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\PostRepository;
use App\Model\Post;

class UpdatePostController
{
    public function execute(string $id, ?array $input)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        // It handles the form submission when there is an input.
        if ($input !== null) {
            if (
                isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
                !empty(trim($input['title'])) && !empty(trim($input['chapo'])) && !empty(trim($input['content'])) && !empty(trim($input['author']))
            ) {
                $post = new Post();
                $post->title = $input['title'];
                $post->chapo = $input['chapo'];
                $post->content = $input['content'];
                $post->author = $input['author'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $success = $postRepository->updatePost($id, $post->title, $post->chapo, $post->content, $post->author);

            if (!$success) {
                throw new \Exception("Impossible de modifier l'article' !");
            }
            //} else {
            header('Location: index.php?action=posts');
            exit;
            //}
        }

        // Otherwise, it displays the form.
        $post = $postRepository->getPost($id);

        if ($post === null) {
            throw new \Exception("L'article $id n'existe pas.");
        }

        require 'templates/admin/update_post.php';
        // } else {
        //     throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        // }
    }
}
