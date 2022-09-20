<?php

namespace App\Controllers\Blog;

require_once('src/lib/database.php');
require_once('src/model/post.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\Post;
use App\Model\Post\PostRepository;

class BlogController
{
    public function execute()
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $allPosts = $postRepository->getPosts();

        // extract last post
        $featuredPost = array_shift($allPosts);

        // find current page
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        // first post of the page
        $postsNb = count($allPosts);
        $perPage = 4;
        $pages = ceil($postsNb / $perPage);
        $numberOne = ($currentPage * $perPage) - $perPage;

        // select posts of the current page
        $statement = $postRepository->connection->getConnection()->prepare(
            "SELECT id, title, chapo, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id< (SELECT max(id) FROM posts) ORDER BY creation_date DESC LIMIT :numberOne, :perpage;"
        );
        $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
        $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $post = new Post();

            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->chapo = $row['chapo'];
            $post->frenchCreationDate = $row['french_creation_date'];

            $posts[] = $post;
        }

        require('templates/blog.php');
    }
}

// function blog()
// {
//     $postRepository = new PostRepository();
//     $postRepository->connection = new DatabaseConnection();

//     $allPosts = $postRepository->getPosts();

//     // extract last post
//     $featuredPost = array_shift($allPosts);

//     // find current page
//     if (isset($_GET['page']) && !empty($_GET['page'])) {
//         $currentPage = (int) strip_tags($_GET['page']);
//     } else {
//         $currentPage = 1;
//     }

//     // first post of the page
//     $postsNb = count($allPosts);
//     $perPage = 4;
//     $pages = ceil($postsNb / $perPage);
//     $numberOne = ($currentPage * $perPage) - $perPage;

//     // select posts of the current page
//     $statement = $postRepository->connection->getConnection()->prepare(
//         "SELECT id, title, chapo, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id< (SELECT max(id) FROM posts) ORDER BY creation_date DESC LIMIT :numberOne, :perpage;"
//     );
//     $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
//     $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
//     $statement->execute();

//     $posts = [];
//     while ($row = $statement->fetch()) {
//         $post = new Post();

//         $post->id = $row['id'];
//         $post->title = $row['title'];
//         $post->chapo = $row['chapo'];
//         $post->frenchCreationDate = $row['french_creation_date'];

//         $posts[] = $post;
//     }

//     require('templates/blog.php');
// }
