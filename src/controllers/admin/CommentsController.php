<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class CommentsController
{
    public function execute()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();

            $comments = $commentRepository->getComments();

            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = (int) strip_tags($_GET['page']);
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
