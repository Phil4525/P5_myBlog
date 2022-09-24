<?php

namespace App\Repository\Comment;

use App\Lib\Database\DatabaseConnection;
use App\Model\Comment\Comment;

class CommentRepository
{
    public DatabaseConnection $connection;

    function getCommentsByPostId(string $postId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            WHERE post_id = ? 
            ORDER BY comment_date DESC"
        );
        $statement->execute([$postId]);

        $comments = [];

        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function createComment(string $postId, ?string $parentCommentId, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, parent_comment_id, author, comment, comment_date) VALUES(?, ?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$postId, $parentCommentId, $author, $comment]);

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
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $comment = new Comment();

        $comment->id = $row['id'];
        $comment->postId = $row['post_id'];
        $comment->author = $row['author'];
        $comment->comment = $row['comment'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->status = $row['status'];

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
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            ORDER BY comment_date DESC"
        );

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function getCommentsByUsername(string $username): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status 
            FROM comments 
            WHERE author = ? 
            ORDER BY comment_date DESC"
        );
        $statement->execute([$username]);

        $comments = [];

        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function getCommentsWaitingForValidation(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status 
            FROM comments
            WHERE status = 'waiting_for_validation'"
        );

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function getValidatedCommentsByPostId(string $postId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            WHERE post_id = ? AND status = 'validated'
            ORDER BY comment_date DESC"
        );
        $statement->execute([$postId]);

        $comments = [];

        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function getCommentsWithChildrenByPostId(string $postId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, parent_comment_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            WHERE post_id = ? AND status = 'validated' AND parent_comment_id IS NULL
            ORDER BY comment_date DESC"
        );
        $statement->execute([$postId]);

        $comments = [];

        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->parentCommentId = $row['parent_comment_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        foreach ($comments as $comment) {
            $comment->children[] = $this->getChildComments($comment->id);
        }

        return $comments;
    }

    function getChildComments(string $commentId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, post_id, parent_comment_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, status
            FROM comments 
            WHERE parent_comment_id = ? AND status = 'validated'
            ORDER BY comment_date DESC"
        );
        $statement->execute([$commentId]);

        $comments = [];

        while ($row = $statement->fetch()) {
            $comment = new Comment();

            $comment->id = $row['id'];
            $comment->postId = $row['post_id'];
            $comment->parentCommentId = $row['parent_comment_id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->status = $row['status'];
            $comment->children[] = $this->getChildComments($comment->id);

            $comments[] = $comment;
        }

        return $comments;
    }

    function updateCommentStatus(string $id, string $status): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET status = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$status, $id]);

        return ($affectedLines > 0);
    }
}
