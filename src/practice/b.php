<?php
session_start();


interface Firewall{}

class SessionFirewall implements Firewall{
    function __construct(){
        var_dump(self::class);
    }
}

$object = new SessionFirewall();

var_dump($_SERVER['HTTP_HTTP_BLJAK'] ?? 'Nema tokena');
