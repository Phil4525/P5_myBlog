<?php
require_once('src/model/post.php');

function addPost($input)
{
    if ($input !== null) {
        if (
            isset($input['title'], $input['chapo'], $input['content'], $input['author']) &&
            !empty($input['title']) && !empty($input['chapo']) && !empty($input['content']) && !empty($input['author'])
        ) {
            $title = $input['title'];
            $chapo = $input['chapo'];
            $content = $input['content'];
            $author = $input['author'];
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }

        $success = createPost($title, $chapo, $content, $author);

        if (!$success) {
            throw new Exception("Impossible d'ajouter l'article' !");
        } else {
            header('Location: index.php?action=adminPosts');
        }
    }
    require('templates/admin/new_post.php');
}
