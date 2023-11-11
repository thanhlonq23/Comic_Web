<?php

class Order
{
    private $id;
    private $timestamp;
    private $transaction_id;
    private $recharge_id;
    private $user_id;

    public function __construct($id, $timestamp, $transaction_id, $recharge_id, $user_id)
    {
        $this->id = $id;
        $this->timestamp = $timestamp;
        $this->transaction_id = $transaction_id;
        $this->recharge_id = $recharge_id;
        $this->user_id = $user_id;
    }

    // Getter methods
    public function getOrderId()
    {
        return $this->id;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    public function getRechargeId()
    {
        return $this->recharge_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter methods
    public function setOrderId($id)
    {
        $this->id = $id;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    public function setRechargeId($recharge_id)
    {
        $this->recharge_id = $recharge_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // Phương thức toString
    public function __toString()
    {
        return "Order ID: " . $this->id .
            "<br> Timestamp: " . $this->timestamp .
            "<br> Transaction ID: " . $this->transaction_id .
            "<br> Recharge ID: " . $this->recharge_id .
            "<br> User ID: " . $this->user_id;
    }
}
