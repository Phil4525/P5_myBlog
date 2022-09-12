<?php

namespace App\Model\Comment;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;

class Comment
{
    public string $id;
    public string $postId;
    public string $author;
    public string $comment;
    public string $frenchCreationDate;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    function getCommentsByPostId(string $postId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$postId]);

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function createComment(string $postId, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$postId, $author, $comment]);

        return ($affectedLines > 0);
    }

    function updateComment(string $id, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET comment = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$comment, $id]);

        return ($affectedLines > 0);
    }

    function getComment(string $id): Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, post_id FROM comments WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $comment = new Comment();

        $comment->id = $row['id'];
        $comment->postId = $row['post_id'];
        $comment->author = $row['author'];
        $comment->comment = $row['comment'];
        $comment->frenchCreationDate = $row['french_creation_date'];

        return $comment;
    }

    function deleteComment(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }

    function getComments(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM comments ORDER BY comment_date DESC"
        );

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];

            $comments[] = $comment;
        }

        return $comments;
    }
}
