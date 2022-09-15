<?php

namespace App\Controllers\Admin\Posts;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;
use App\Model\Post\Post;
use App\Model\Comment\CommentRepository;

class PostsController
{
    public function execute()
    {
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
        $numberOne = ($currentPage * $perPage) - $perPage;

        // select posts of the current page
        $statement = $postRepository->connection->getConnection()->prepare(
            "SELECT id, title, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
            DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date FROM posts WHERE id<= (SELECT max(id) FROM posts) ORDER BY creation_date DESC LIMIT :numberOne, :perpage;"
        );
        $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
        $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $statement->execute();

        $posts = [];

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComments();

        while ($row = $statement->fetch()) {
            $post = new Post();
            $commentsNb = 0;

            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->author = $row['author'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->frenchModificationDate = $row['french_modification_date'];

            foreach ($comments as $comment) {
                if ($post->id == $comment->postId) {
                    $commentsNb++;
                }
            }

            $posts[] = [$post, $commentsNb];
        }

        require('templates/admin/post.php');
    }
}
