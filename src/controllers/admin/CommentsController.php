<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class CommentsController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();
        $session = $globals->getSESSION('user');

        if (isset($session) && $session['role'] == 'admin') {

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();

            $comments = $commentRepository->getComments();

            if (isset($get['page']) && !empty($get['page'])) {
                $currentPage = (int) strip_tags($get['page']);
            } else {
                $currentPage = 1;
            }

            $commentsNb = count($comments);
            $perPage = 5;
            $pages = ceil($commentsNb / $perPage);
            $offset = ($currentPage * $perPage) - $perPage;

            $comments = array_slice($comments, $offset, $perPage);

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $posts = $postRepository->getPosts();

            foreach ($comments as $comment) {
                $postTitle = "L'article a été supprimé.";
                foreach ($posts as $post) {
                    if ($comment->postId == $post->id) {
                        $postTitle = $post->title;
                    }
                }
                $commentsWithPostTitle[] = [$comment, $postTitle];
            }

            require 'templates/admin/comment.php';
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
