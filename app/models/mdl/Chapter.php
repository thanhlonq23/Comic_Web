<?php
class Chapter
{
    private $id;
    private $webtoon_id;
    private $title;
    private $price;
    private $status;
    private $views;
    private $date;
    private $media;

    public function __construct($id, $webtoon_id, $title, $price, $status, $views, $date, $media)
    {
        $this->id = $id;
        $this->webtoon_id = $webtoon_id;
        $this->title = $title;
        $this->price = $price;
        $this->status = $status;
        $this->views = $views;
        $this->date = $date;
        $this->media = $media;
    }

    // Getter methods
    public function getChapterId()
    {
        return $this->id;
    }

    public function getWebtoonId()
    {
        return $this->webtoon_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getMedia()
    {
        return $this->media;
    }

    // Setter methods
    public function setChapterId($id)
    {
        $this->id = $id;
    }

    public function setWebtoonId($webtoon_id)
    {
        $this->webtoon_id = $webtoon_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setViews($views)
    {
        $this->views = $views;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    // Phương thức toString
    public function __toString()
    {
        $dateFormatted = $this->date->format("d-m-Y");

        return "Chapter ID: " . $this->id .
            "<br> Webtoon ID: " . $this->webtoon_id .
            "<br> Title: " . $this->title .
            "<br> Price: " . $this->price .
            "<br> Status: " . $this->status .
            "<br> Views: " . $this->views .
            "<br> Date: " . $dateFormatted .
            "<br> Media: " . $this->media;
    }
}
