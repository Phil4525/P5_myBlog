<?php
require_once('src/model.php');

function getCommentsByPostId(string $postId)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$postId]);

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}

function getComments()
{
    $database = dbConnect();

    $statement = $database->query(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM comments ORDER BY comment_date DESC"
    );

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}

function getComment(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date, post_id FROM comments WHERE id = ?"
    );
    $statement->execute([$id]);

    $comment = $statement->fetch(PDO::FETCH_ASSOC);

    return $comment;
}

function createComment(string $postId, string $author, string $comment)
{
    $database = dbConnect();

    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$postId, $author, $comment]);

    return ($affectedLines > 0);
}

function updateComment(string $id, string $comment)
{
    $database = dbConnect();

    $statement = $database->prepare(
        // 'UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?'
        'UPDATE comments SET comment = ? WHERE id = ?'
    );
    $affectedLines = $statement->execute([$comment, $id]);

    return ($affectedLines > 0);
}

function deleteComment(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare('DELETE FROM comments WHERE id = ?');
    $affectedLines = $statement->execute([$id]);

    return ($affectedLines > 0);
}
