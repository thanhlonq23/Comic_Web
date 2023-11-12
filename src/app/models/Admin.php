<?php
class Admin
{
    private $id;
    private $username;
    private $password;
    private $name;
    private $dateOfBirth;
    private $phoneNumber;
    private $email;
    private $media;

    public function __construct($id, $username, $password, $name, $dateOfBirth, $phoneNumber, $email, $media)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->media = $media;
    }

    // Getter methods
    public function getAdminId()
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

    // Setter methods
    public function setAdminId($id)
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

    // Phương thức toString
    public function __toString()
    {
        $dateOfBirthFormatted = $this->dateOfBirth->format("d-m-Y");

        return "Admin ID: " . $this->id .
            "<br> Username: " . $this->username .
            "<br> Password: " . $this->password .
            "<br> Name: " . $this->name .
            "<br> Date of Birth: " . $dateOfBirthFormatted .
            "<br> Phone Number: " . $this->phoneNumber .
            "<br> Email: " . $this->email .
            "<br> Media: " . $this->media;
    }
}
