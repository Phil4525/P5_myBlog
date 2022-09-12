<?php

namespace App\Controllers\Admin\UpdatePost;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;

class UpdatePostController
{
    public function execute(string $id, ?array $input)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        // It handles the form submission when there is an input.
        if ($input !== null) {
            if (
                isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
                !empty($input['title']) && !empty($input['chapo']) && !empty($input['content']) && !empty($input['author'])
            ) {
                $post = [
                    'title' => $input['title'],
                    'chapo' => $input['chapo'],
                    'content' => $input['content'],
                    'author' => $input['author'],
                ];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $success = $postRepository->updatePost($id, $post['title'], $post['chapo'], $post['content'], $post['author']);

            if (!$success) {
                throw new \Exception('Impossible de modifier le commentaire !');
            } else {
                header('Location: index.php?action=adminPosts');
            }
        }

        // Otherwise, it displays the form.
        $post = $postRepository->getPost($id);

        if ($post === null) {
            throw new \Exception("Le commentaire $id n'existe pas.");
        }

        require('templates/admin/update_post.php');
    }
}

// function modifyPost(string $id, ?array $input)
// {
//     $postRepository = new PostRepository();
//     $postRepository->connection = new DatabaseConnection();

//     // It handles the form submission when there is an input.
//     if ($input !== null) {
//         if (
//             isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
//             !empty($input['title']) && !empty($input['chapo']) && !empty($input['content']) && !empty($input['author'])
//         ) {
//             $post = [
//                 'title' => $input['title'],
//                 'chapo' => $input['chapo'],
//                 'content' => $input['content'],
//                 'author' => $input['author'],
//             ];
//         } else {
//             throw new Exception('Les données du formulaire sont invalides.');
//         }

//         $success = $postRepository->updatePost($id, $post['title'], $post['chapo'], $post['content'], $post['author']);

//         if (!$success) {
//             throw new Exception('Impossible de modifier le commentaire !');
//         } else {
//             header('Location: index.php?action=adminPosts');
//         }
//     }

//     // Otherwise, it displays the form.
//     $post = $postRepository->getPost($id);

//     if ($post === null) {
//         throw new Exception("Le commentaire $id n'existe pas.");
//     }

//     require('templates/admin/update_post.php');
// }
