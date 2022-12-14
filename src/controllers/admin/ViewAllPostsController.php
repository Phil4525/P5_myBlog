<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class ViewAllPostsController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $posts = $postRepository->getPosts();

        // find current page
        if (isset($get['page']) && !empty($get['page'])) {
            $currentPage = (int) strip_tags($get['page']);
        } else {
            $currentPage = 1;
        }

        // first post of page
        $postsNb = count($posts);
        $perPage = 15;
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

        require 'templates/admin/post.php';
    }
}
