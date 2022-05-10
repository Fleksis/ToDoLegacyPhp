<?php

namespace App\Models;
require_once '../database/db.php';
class User {
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    public function __construct(string $firstName, string $lastName, string $email, string $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    public function FirstName():string {
        return $this->firstName;
    }

    public function LastName():string {
        return $this->lastName;
    }

    public function Email():string {
        return $this->email;
    }

    public function Password():string {
        return $this->password;
    }

    public function NewUser($conn):void {
        $firstName = $this->Firstname();
        $lastName = $this->LastName();
        $email = $this->Email();
        $password = $this->Password();

        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $conn->exec($sql);
    }
}

