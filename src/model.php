<?php

function dbConnect(PostRepository $repository)
{
    if ($repository->database === null) {
        $repository->database = new PDO('mysql:host=localhost;dbname=P5_myBlog;charset=utf8', 'root', '');
    }
}
