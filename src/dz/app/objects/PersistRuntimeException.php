<?php

class PersistRuntimeException extends RuntimeException{
    private $number;

    public function __construct(int $number, Throwable $previous = NULL){
        parent::__construct('Greska kod: '.$number, 0, $previous);
        $this->number = $number;
    }
}