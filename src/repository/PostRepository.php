<?php

namespace App\Repository;

use App\lib\DatabaseConnection;
use App\Model\Post;

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPost(string $id): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, author,
            DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
            DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date 
            FROM posts 
            WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $post = new Post(
            $row['id'],
            $row['title'],
            $row['chapo'],
            $row['content'],
            $row['author'],
            $row['french_creation_date'],
            $row['french_modification_date']
        );

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, chapo, content, author, 
            DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
            DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date 
            FROM posts 
            ORDER BY creation_date DESC"
        );

        $posts = [];

        while ($row = $statement->fetch()) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['chapo'],
                $row['content'],
                $row['author'],
                $row['french_creation_date'],
                $row['french_modification_date']
            );

            $posts[] = $post;
        }

        return $posts;
    }

    public function createPost(string $title, string $chapo, string $content, string $author): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO posts(title, chapo, content, author, creation_date) 
            VALUES(?, ?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author]);

        return ($affectedLines > 0);
    }

    public function updatePost(string $id, string $title, string $chapo, string $content, string $author): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts 
            SET title = ?, chapo = ?, content = ?,author = ?, modification_date = NOW() 
            WHERE id = ?'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author, $id]);

        return ($affectedLines > 0);
    }

    public function deletePost(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }

    public function getMostCommentedPost(): array
    {
        $statement = $this->connection->getConnection()->query(
            'SELECT posts.id, COUNT(comments.id) AS comments_number, posts.title 
            FROM posts 
            INNER JOIN comments ON comments.post_id = posts.id 
            GROUP BY posts.id 
            ORDER BY comments_number DESC LIMIT 0,1'
        );
        $row = $statement->fetch();

        $mostCommentedPost = [
            'id' => $row['id'],
            'title' => $row['title'],
            'comments_number' => $row['comments_number']
        ];

        return $mostCommentedPost;
    }

    public function searchPosts(string $keyword): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, author, creation_date, modification_date
            FROM posts 
            WHERE title LIKE :keyword OR chapo LIKE :keyword OR content LIKE :keyword OR author LIKE :keyword
            ORDER BY creation_date DESC"
        );
        $statement->bindValue(':keyword', '%' . $keyword . '%', \PDO::PARAM_STR);
        $statement->execute();

        $posts = [];

        while ($row = $statement->fetch()) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['chapo'],
                $row['content'],
                $row['author'],
                $row['creation_date'],
                $row['modification_date']
            );

            $posts[] = $post;
        }

        return $posts;
    }
}
