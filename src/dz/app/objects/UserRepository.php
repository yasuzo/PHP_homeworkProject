<?php

class UserRepository{
    private $baza;

    public function __construct(string $path){
        $this->baza = $path;
        return;
    }


    public function findByUsername(string $username): array{
        $korisnici = read_json_file($this->baza);
        $key = array_search($username, array_column($korisnici, 'username'));
        return $key === false ? [] : $korisnici[$key];
    }

    public function persist(User $user): void{
        if(is_file($this->baza) === false){
            touch($this->baza);
        }
        $array = read_json_file($this->baza);

        $data = ['username' => $user->username(), 'password' => $user->password()];
    
        $array[] = $data;
    
        $array = json_encode($array, JSON_PRETTY_PRINT);

        file_put_contents($this->baza, $array);
        
        return;
    }
}