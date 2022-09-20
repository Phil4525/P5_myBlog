<?php

namespace App\Controllers\Post;

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;
use App\Model\Comment\CommentRepository;

class PostController
{
    public function execute(string $id)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($id);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getValidatedCommentsWithChildrenByPostId($id);

        // foreach ($parentComments as $comment) {
        //     $childComments[] = $commentRepository->getChildComments($comment->id);
        // }
        // $comments = $commentsById = $commentRepository->getValidatedCommentsById($id);;
        // foreach ($comments as $id => $comment) {
        //     if ($comment->parentCommentId !== null) {
        //         $commentsById[$comment->parentCommentId]->children[] = $comment;
        //     }
        //     $comments[] = $comment;
        // }


        require('templates/post.php');
    }
}
