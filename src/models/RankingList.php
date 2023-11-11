<?php

class RankingList
{
    private $id;
    private $webtoon_id;
    private $name;

    public function __construct($id, $webtoon_id, $name)
    {
        $this->id = $id;
        $this->webtoon_id = $webtoon_id;
        $this->name = $name;
    }

    // Getter methods
    public function getRankingId()
    {
        return $this->id;
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
    public function setRankingId($id)
    {
        $this->id = $id;
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
        return "Ranking ID: " . $this->id .
            "<br> Webtoon ID: " . $this->webtoon_id .
            "<br> Name: " . $this->name;
    }
}
