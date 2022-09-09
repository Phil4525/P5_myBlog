<?php
require_once('src/models/post.php');

function modifyPost(string $id, ?array $input)
{
    // It handles the form submission when there is an input.
    if ($input !== null) {
        // $post[] = null;
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
            throw new Exception('Les données du formulaire sont invalides.');
        }

        $success = updatePost($id, $post['title'], $post['chapo'], $post['content'], $post['author']);

        if (!$success) {
            throw new Exception('Impossible de modifier le commentaire !');
        } else {
            $newComment = getComment($id);
            header('Location: index.php?action=adminPosts');
        }
    }

    // Otherwise, it displays the form.
    $post = getPost($id);
    if ($post === null) {
        throw new Exception("Le commentaire $id n'existe pas.");
    }

    require('templates/admin/edit_post.php');
}
