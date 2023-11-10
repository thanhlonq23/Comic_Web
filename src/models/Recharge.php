<?php
class Recharge
{
    private $recharge_id;
    private $price;
    private $coinAmount;

    public function __construct($recharge_id, $price, $coinAmount)
    {
        $this->recharge_id = $recharge_id;
        $this->price = $price;
        $this->coinAmount = $coinAmount;
    }

    // Getter methods
    public function getRechargeId()
    {
        return $this->recharge_id;
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
    public function setRechargeId($recharge_id)
    {
        $this->recharge_id = $recharge_id;
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
        return "Recharge ID: " . $this->recharge_id .
            "<br> Price: " . $this->price .
            "<br> Coin Amount: " . $this->coinAmount;
    }
}
