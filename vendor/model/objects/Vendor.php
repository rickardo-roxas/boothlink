<?php

namespace model\objects;
class Vendor
{
    private $email;
    private $username;
    private $lastName;
    private $firstName;
    private $password;
    private $organizations = array();

    public function __construct($email, $username, $lastName, $firstName, $password, $organizations)
    {
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->password = $password;
        $this->organizations = $organizations;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;
    }
}
