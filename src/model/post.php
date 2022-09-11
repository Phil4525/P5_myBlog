<?php
require_once('src/lib/database.php');

class Post
{
    public string $id;
    public string $title;
    public string $chapo;
    public string $content;
    public string $author;
    public string $frenchCreationDate;
}

class PostRepository
{
    public DatabaseConnection $connection;

    function getPost(string $id): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id = ?"
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

        return $post;
    }

    function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts ORDER BY creation_date DESC"
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
            'UPDATE posts SET title = ?, chapo = ?, content = ?,author = ?, creation_date = NOW() WHERE id = ?'
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
}
