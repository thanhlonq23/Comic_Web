<?php
class Category
{
    private $category_id;
    private $name;

    public function __construct($category_id, $name)
    {
        $this->category_id = $category_id;
        $this->name = $name;
    }

    // Getter methods
    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setter methods
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Category ID: " . $this->category_id .
            "<br> Name: " . $this->name;
    }
}
