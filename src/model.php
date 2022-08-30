<?php

function getPosts()
{
    $database = dbConnect();

    // We retrieve the 5 last blog posts.
    $statement = $database->query(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 4"
    );
    $posts = [];
    while (($row = $statement->fetch())) {
        $post = [
            'id' => $row['id'],
            'title' => $row['title'],
            'chapo' => $row['chapo'],
            'content' => $row['content'],
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
        ];

        $posts[] = $post;
    }

    return $posts;
}

function getPost(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$id]);

    $row = $statement->fetch();
    $post = [
        // 'id' => $row['id'],
        'title' => $row['title'],
        'chapo' => $row['chapo'],
        'content' => $row['content'],
        'author' => $row['author'],
        'french_creation_date' => $row['french_creation_date'],
    ];

    return $post;
}

function dbConnect()
{
    try {
        $database = new PDO('mysql:host=localhost;dbname=P5_myBlog;charset=utf8', 'root', '');

        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
