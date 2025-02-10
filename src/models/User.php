<?php

class User
{
    private $userID;
    private $email;
    private $password;
    private $nickname;
    private $name;
    private $surname;

    public function __construct(string $email, string $password, string $nickname, string $name, string $surname, string $userID = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->surname = $surname;
        $this->userID = $userID;
    }


    public function getUserID(): string
    {
        return $this->userID;
    }
    public function setUserID(string $userID)
    {
        $this->userID = $userID;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getNickname(): string
    {
        return $this->nickname;
    }
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }


}