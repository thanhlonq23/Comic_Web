<?php
class Category
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // Getter methods
    public function getCategoryId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setter methods
    public function setCategoryId($id)
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
        return "Category ID: " . $this->id .
            "<br> Name: " . $this->name;
    }
}
