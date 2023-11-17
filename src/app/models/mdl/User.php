<?php
class User
{
    private $id;
    private $username;
    private $password;
    private $name;
    private $dateOfBirth = "2023-11-10";
    private $phoneNumber;
    private $email;
    private $media;
    private $wallet;

    public function __construct($id, $username, $password, $name, $dateOfBirth, $phoneNumber, $email, $media, $wallet)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->media = $media;
        $this->wallet = $wallet;
    }

    public function getid()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMedia()
    {
        return $this->media;
    }
    public function getWallet()
    {
        return $this->wallet;
    }


    // Setter methods
    public function setid($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        $dateOfBirthFormatted = $this->dateOfBirth->format("d-m-Y");
        return "User id: " . $this->id .
            "<br> Username: " . $this->username .
            "<br> Name: " . $this->name .
            "<br> Date of Birth: " . $dateOfBirthFormatted .
            "<br> Phone Number: " . $this->phoneNumber .
            "<br> Email: " . $this->email .
            "<br> Media: " . $this->media .
            "<br> Wallet: " . $this->wallet;
    }
}
