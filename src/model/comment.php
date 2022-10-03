<?php

namespace App\Model;

class Comment
{
    public string $id;
    public string $postId;
    public ?string $parentCommentId;
    public string $author;
    public string $comment;
    public string $frenchCreationDate;
    public string $status;

    public function __construct(
        string $id,
        string $postId,
        ?string $parentCommentId,
        string $author,
        string $comment,
        string $frenchCreationDate,
        string $status
    ) {
        $this->id = $id;
        $this->postId = $postId;
        $this->parentCommentId = $parentCommentId;
        $this->author = $author;
        $this->comment = $comment;
        $this->frenchCreationDate = $frenchCreationDate;
        $this->status = $status;
    }
}
