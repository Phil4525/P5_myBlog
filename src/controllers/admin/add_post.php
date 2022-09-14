<?php

namespace App\Controllers\Admin\AddPost;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;

class AddPostController
{
    public function execute(array $input)
    {
        if ($input !== null) {

            if (
                isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
                !empty(trim($input['title'])) && !empty(trim($input['title'])) && !empty(trim($input['title'])) && !empty(trim($input['title']))
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
            } else {
                header('Location: index.php?action=adminPosts');
            }
        }

        require('templates/admin/new_post.php');
    }
}

// function addPost($input)
// {
//     if ($input !== null) {

//         if (
//             isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
//             !empty($input['title']) && !empty($input['chapo']) && !empty($input['content']) && !empty($input['author'])
//         ) {
//             $title = $input['title'];
//             $chapo = $input['chapo'];
//             $content = $input['content'];
//             $author = $input['author'];
//         } else {
//             throw new Exception('Les données du formulaire sont invalides.');
//         }

//         $postRepository = new PostRepository();
//         $postRepository->connection = new DatabaseConnection();

//         $success = $postRepository->createPost($title, $chapo, $content, $author);

//         if (!$success) {
//             throw new Exception("Impossible d'ajouter l'article' !");
//         } else {
//             header('Location: index.php?action=adminPosts');
//         }
//     }

//     require('templates/admin/new_post.php');
// }
