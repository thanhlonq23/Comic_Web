<?php

class Reading
{
    private $reading_id;
    private $user_id;
    private $webtoon_id;
    private $name;

    public function __construct($reading_id, $user_id, $webtoon_id, $name)
    {
        $this->reading_id = $reading_id;
        $this->user_id = $user_id;
        $this->webtoon_id = $webtoon_id;
        $this->name = $name;
    }

    // Getter methods
    public function getReadingId()
    {
        return $this->reading_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getWebtoonId()
    {
        return $this->webtoon_id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setter methods
    public function setReadingId($reading_id)
    {
        $this->reading_id = $reading_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setWebtoonId($webtoon_id)
    {
        $this->webtoon_id = $webtoon_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Reading ID: " . $this->reading_id .
            "<br> User ID: " . $this->user_id .
            "<br> Webtoon ID: " . $this->webtoon_id .
            "<br> Name: " . $this->name;
    }
}
