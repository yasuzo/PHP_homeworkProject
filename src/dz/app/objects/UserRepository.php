<?php

class UserRepository{
    private $baza;

    public function __construct(string $path){
        $this->baza = $path;
        return;
    }
    public function findUsers(): array{
        $array = [];
        if(is_file($this->baza) === true){
            $array = @file_get_contents($this->baza);
            if($array === false)
                throw new UnableToOpenStreamException('Greska - Nije moguce procitati datoteku!');
            $array = json_decode($array, true);
        }
        return (array)$array;
    }

    public function findByUsername(string $username): array{
        $korisnici = $this->findUsers();
        $key = array_search($username, array_column($korisnici, 'username'));
        return $key === false ? [] : $korisnici[$key];
    }

    public function persist(User $user): void{
        if(is_file($this->baza) === false){
            touch($this->baza);
        }
        $array = $this->findUsers();

        $data = ['username' => $user->username(), 'password' => $user->password()];
    
        $array[] = $data;
    
        $array = json_encode($array, JSON_PRETTY_PRINT);

        if(@file_put_contents($this->baza, $array) === false)
            throw new PersistRuntimeException('Greska - Nije moguce spremiti podatak!');
        
        return;
    }

    public function credentialsOK(string $username, string $password): bool{
        if(empty($user = $this->findByUsername($username))){
            return false;
        }
    
        return password_verify($password, $user['password']);
    }
}