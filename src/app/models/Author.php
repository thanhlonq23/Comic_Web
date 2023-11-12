<?php
class Author
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // Getter methods
    public function getAuthorId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setter methods
    public function setAuthorId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Author ID: " . $this->id .
            "<br> Name: " . $this->name;
    }
}
