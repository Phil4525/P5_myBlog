<?php

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
    public ?PDO $database = null;
}

// function getPosts()
// {
//     $database = dbConnect();

//     $statement = $database->query(
//         "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts ORDER BY creation_date DESC"
//     );

//     $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

//     return $posts;
// }

function getPosts(PostRepository $repository): array
{
    dbConnect($repository);

    $statement = $repository->database->query(
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
        $post->authorfrenchCreationDate = $row['french_creation_date'];

        $posts[] = $post;
    }

    return $posts;
}

function getPost(PostRepository $repository, string $id): Post
{
    dbConnect($repository);

    $statement = $repository->database->prepare(
        "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$id]);

    $post = new Post;
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

function deletePost(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare('DELETE FROM posts WHERE id = ?');
    $affectedLines = $statement->execute([$id]);

    return ($affectedLines > 0);
}
