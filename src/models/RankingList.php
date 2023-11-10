<?php

class RankingList
{
    private $ranking_id;
    private $webtoon_id;
    private $name;

    public function __construct($ranking_id, $webtoon_id, $name)
    {
        $this->ranking_id = $ranking_id;
        $this->webtoon_id = $webtoon_id;
        $this->name = $name;
    }

    // Getter methods
    public function getRankingId()
    {
        return $this->ranking_id;
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
    public function setRankingId($ranking_id)
    {
        $this->ranking_id = $ranking_id;
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
        return "Ranking ID: " . $this->ranking_id .
            "<br> Webtoon ID: " . $this->webtoon_id .
            "<br> Name: " . $this->name;
    }
}
