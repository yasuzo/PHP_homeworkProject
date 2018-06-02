<?php

declare(strict_types=1);

class User{
    private $username, $password;
    public function __construct(string $user, string $pass){
        $this->username = $user;
        $this->password = $pass;
    }

    public function username(): string{
        return $this->username;
    }

    public function password(): string{
        return $this->password;
    }
}