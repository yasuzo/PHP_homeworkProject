<?php

class UserRepository{
    private $baza;

    public function __construct(PDO $db){
        $this->baza = $db;
        $query = <<<SQL
        CREATE TABLE IF NOT EXISTS users(
            id          int not null AUTO_INCREMENT primary key,
            username    varchar(40) not null unique,
            pass        varchar(256) not null
        );
SQL;
        $db->query($query);
    }

    public function findByUsername(string $username): ?array{
        $query = <<<SQL
        select username, pass
        from users
        where username=:user;
SQL;
        $query = $this->baza->prepare($query);
        $query->execute([':user' => $username]);
        return $query->fetch() ?: null;
    }

    public function persist(User $user): void{
        $query = <<<SQL
        insert into users
        (username, pass) values
        (:user, :pass);
SQL;
        $query = $this->baza->prepare($query);
        $query->execute([':user' => $user->username(), ':pass' => $user->password()]);
    }

    public function credentialsOK(string $username, string $password): bool{
        if(($user = $this->findByUsername($username)) === null){
            return false;
        }
    
        return password_verify($password, $user['pass']);
    }
}