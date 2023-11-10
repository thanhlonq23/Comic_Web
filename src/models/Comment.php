<?php
class Comment
{
    private $comment_id;
    private $chapter_id;
    private $user_id;
    private $content;
    private $timestamp;
    private $reaction;

    public function __construct($comment_id, $chapter_id, $user_id, $content, $timestamp, $reaction)
    {
        $this->comment_id = $comment_id;
        $this->chapter_id = $chapter_id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->timestamp = $timestamp;
        $this->reaction = $reaction;
    }

    // Getter methods
    public function getCommentId()
    {
        return $this->comment_id;
    }

    public function getChapterId()
    {
        return $this->chapter_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getReaction()
    {
        return $this->reaction;
    }

    // Setter methods
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    public function setChapterId($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function setReaction($reaction)
    {
        $this->reaction = $reaction;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Comment ID: " . $this->comment_id .
            "<br> Chapter ID: " . $this->chapter_id .
            "<br> User ID: " . $this->user_id .
            "<br> Content: " . $this->content .
            "<br> Timestamp: " . $this->timestamp .
            "<br> Reaction: " . $this->reaction;
    }
}
