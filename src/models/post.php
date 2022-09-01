<?php

function getPosts()
{
    $database = dbConnect();

    $statement = $database->query(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM posts ORDER BY creation_date DESC"
    );

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function getPost(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$id]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);


    return $post;
}
