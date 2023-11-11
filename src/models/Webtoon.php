<?php
class Webtoon
{
    private $id;
    private $category_id;
    private $author_id;
    private $name;
    private $status;
    private $rating;
    private $favorite;
    private $date;

    public function __construct($id, $category_id, $author_id, $name, $status, $rating, $favorite, $date)
    {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
        $this->name = $name;
        $this->status = $status;
        $this->rating = $rating;
        $this->favorite = $favorite;
        $this->date = $date;
    }

    // Getter methods
    public function getWebtoonId()
    {
        return $this->id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getFavorite()
    {
        return $this->favorite;
    }

    public function getDate()
    {
        return $this->date;
    }

    // Setter methods
    public function setWebtoonId($id)
    {
        $this->id = $id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    // Phương thức toString
    public function __toString()
    {
        $dateOfBirthFormatted = $this->date->format("d-m-Y");
        return "Webtoon ID: " . $this->id .
            "<br> Category ID: " . $this->category_id .
            "<br> Author ID: " . $this->author_id .
            "<br> Name: " . $this->name .
            "<br> Status: " . $this->status .
            "<br> Rating: " . $this->rating .
            "<br> Favorite: " . $this->favorite .
            "<br> Date: " . $dateOfBirthFormatted;
    }
}
