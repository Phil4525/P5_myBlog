<?php

namespace App\Controllers\Admin\Comments;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\CommentRepository;
use App\Model\Comment\Comment;
use App\Model\Post\PostRepository;
use App\Model\Post\Post;

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
            $numberOne = ($currentPage * $perPage) - $perPage;

            $statement = $commentRepository->connection->getConnection()->prepare(
                "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status 
                FROM comments 
                WHERE id<= (SELECT max(id) 
                FROM comments) 
                ORDER BY comment_date DESC 
                LIMIT :numberOne, :perpage;"
            );
            $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
            $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
            $row = $statement->execute();

            $comments = [];

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $posts = $postRepository->getPosts();

            while ($row = $statement->fetch()) {
                $comment = new Comment();

                $comment->id = $row['id'];
                $comment->postId = $row['post_id'];
                $comment->author = $row['author'];
                $comment->comment = $row['comment'];
                $comment->frenchCreationDate = $row['french_creation_date'];
                $comment->status = $row['status'];

                $postTitle = "L'article a été supprimé.";

                foreach ($posts as $post) {
                    if ($comment->postId == $post->id) {
                        $postTitle = $post->title;
                    }
                }

                $comments[] = [$comment, $postTitle];
            }

            require('templates/admin/comment.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
