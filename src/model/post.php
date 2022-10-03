<?php

namespace App\Model;

// class Post
// {
//     public string $id;
//     public string $title;
//     public string $chapo;
//     public string $content;
//     public string $author;
//     public string $frenchCreationDate;
//     public ?string $frenchModificationDate;
// }

class Post
{
    public string $id;
    public string $title;
    public string $chapo;
    public string $content;
    public string $author;
    public string $frenchCreationDate;
    public ?string $frenchModificationDate;

    public function __construct(
        string $id,
        string $title,
        string $chapo,
        string $content,
        string $author,
        string $frenchCreationDate,
        ?string $frenchModificationDate
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->chapo = $chapo;
        $this->content = $content;
        $this->author = $author;
        $this->frenchCreationDate = $frenchCreationDate;
        $this->frenchModificationDate = $frenchModificationDate;
    }
}
