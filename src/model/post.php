<?php

namespace App\Model\Post;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;

class Post
{
    public string $id;
    public string $title;
    public string $chapo;
    public string $content;
    public string $author;
    public string $frenchCreationDate;
    public ?string $frenchModificationDate;
}

class PostRepository
{
    public DatabaseConnection $connection;

    function getPost(string $id): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
            DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date FROM posts WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $post = new Post();

        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->chapo = $row['chapo'];
        $post->content = $row['content'];
        $post->author = $row['author'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->frenchModificationDate = $row['french_modification_date'];

        return $post;
    }

    function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
            DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date FROM posts ORDER BY creation_date DESC"
        );

        $posts = [];

        while ($row = $statement->fetch()) {
            $post = new Post();

            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->chapo = $row['chapo'];
            $post->content = $row['content'];
            $post->author = $row['author'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->frenchModificationDate = $row['french_modification_date'];

            $posts[] = $post;
        }

        return $posts;
    }

    function createPost(string $title, string $chapo, string $content, string $author): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO posts(title, chapo, content, author, creation_date) VALUES(?, ?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author]);

        return ($affectedLines > 0);
    }

    function updatePost(string $id, string $title, string $chapo, string $content, string $author): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET title = ?, chapo = ?, content = ?,author = ?, modification_date = NOW() WHERE id = ?'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author, $id]);

        return ($affectedLines > 0);
    }

    function deletePost(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }

    function getPostByCommentsNumber(): array
    {
        $statement = $this->connection->getConnection()->query(
            'SELECT posts.id, COUNT(comments.id) AS number, posts.title FROM posts 
            INNER JOIN comments ON comments.post_id = posts.id GROUP BY posts.id ORDER BY number DESC LIMIT 0,1'
        );
        $row = $statement->fetch();

        $mostCommentedPost = [
            'post_id' => $row['id'],
            'comments_number' => $row['number'],
            'post_title' => $row['title']
        ];

        return $mostCommentedPost;
    }
}

// SELECT posts.id, COUNT(comments.id) AS number, MAX(posts.title) FROM `posts` 
// INNER JOIN comments ON comments.post_id = posts.id
// GROUP BY posts.id
// ORDER BY number DESC
// LIMIT 0,1