<?php
require_once('src/model.php');

function createReply(string $comment, string $author, string $reply)
{
    $database = dbConnect();

    $statement = $database->prepare(
        'INSERT INTO replies(comment_id, author, reply, reply_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$comment, $author, $reply]);

    return ($affectedLines > 0);
}

function getReplies(string $commentId)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, author, reply, DATE_FORMAT(reply_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM replies WHERE comment_id = ? ORDER BY reply_date DESC"
    );
    $statement->execute([$commentId]);

    $replies = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $replies;
}
