<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Globals\Globals;
use App\Repository\PostRepository;

class AddPostController
{
    public function execute(array $input)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        if ($input !== null) {

            if (
                !isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
                empty(trim($input['title'])) && empty(trim($input['chapo'])) && empty(trim($input['content'])) && !empty(trim($input['author']))
            ) {

                $title = $input['title'];
                $chapo = $input['chapo'];
                $content = $input['content'];
                $author = $input['author'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();

            $success = $postRepository->createPost($title, $chapo, $content, $author);

            if (!$success) {
                throw new \Exception("Impossible d'ajouter l'article' !");
            }
            // } else {
            // header('Location: index.php?action=posts');
            // exit;
            $redirect = new Redirect('index.php?action=posts');
            $redirect->execute();
            // }
        }

        require 'templates/admin/new_post.php';
        // } else {
        //     throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        // }
    }
}
