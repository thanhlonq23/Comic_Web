<?php
class Author
{
    private $author_id;
    private $name;

    public function __construct($author_id, $name)
    {
        $this->author_id = $author_id;
        $this->name = $name;
    }

    // Getter methods
    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setter methods
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Author ID: " . $this->author_id .
            "<br> Name: " . $this->name;
    }
}
