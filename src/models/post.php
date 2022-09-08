<?php

function getPosts()
{
    $database = dbConnect();

    $statement = $database->query(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts ORDER BY creation_date DESC"
    );

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function getPost(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$id]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);


    return $post;
}

function createPost(string $title, string $chapo, string $content, string $author)
{
    $database = dbConnect();
    $statement = $database->prepare('INSERT INTO posts(title, chapo, content, author, creation_date) VALUES(?, ?, ?, ?, NOW())');
    $affectedLines = $statement->execute([$title, $chapo, $content, $author]);
    return ($affectedLines > 0);
}

function updatePost(string $id, string $title, string $chapo, string $content, string $author)
{
    $database = dbConnect();

    $statement = $database->prepare(
        'UPDATE posts SET title = ?, chapo = ?, content = ?,author = ?, creation_date = NOW() WHERE id = ?'
    );
    $affectedLines = $statement->execute([$title, $chapo, $content, $author, $id]);

    return ($affectedLines > 0);
}
