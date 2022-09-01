<?php

function getComments(string $post)
{
    $database = commentDbConnect();

    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$post]);

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}

function createComment(string $post, string $author, string $comment)
{
    $database = commentDbConnect();

    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function commentDbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=P5_myBlog;charset=utf8', 'root', '');
    return $database;
}
