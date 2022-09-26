<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class PostsController
{
    public function execute()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();

            $posts = $postRepository->getPosts();

            // find current page
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = (int) strip_tags($_GET['page']);
            } else {
                $currentPage = 1;
            }

            // first post of the page
            $postsNb = count($posts);
            $perPage = 5;
            $pages = ceil($postsNb / $perPage);
            $offset = ($currentPage * $perPage) - $perPage;

            $posts = array_slice($posts, $offset, $perPage);

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $comments = $commentRepository->getComments();

            foreach ($posts as $post) {
                $commentsNb = 0;
                foreach ($comments as $comment) {
                    if ($post->id == $comment->postId) {
                        $commentsNb++;
                    }
                }
                $postsWithCommentsNb[] = [$post, $commentsNb];
            }

            require('templates/admin/post.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
