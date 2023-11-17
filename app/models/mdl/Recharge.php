<?php
class Recharge
{
    private $id;
    private $price;
    private $coinAmount;

    public function __construct($id, $price, $coinAmount)
    {
        $this->id = $id;
        $this->price = $price;
        $this->coinAmount = $coinAmount;
    }

    // Getter methods
    public function getRechargeId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCoinAmount()
    {
        return $this->coinAmount;
    }

    // Setter methods
    public function setRechargeId($id)
    {
        $this->id = $id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setCoinAmount($coinAmount)
    {
        $this->coinAmount = $coinAmount;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Recharge ID: " . $this->id .
            "<br> Price: " . $this->price .
            "<br> Coin Amount: " . $this->coinAmount;
    }
}
