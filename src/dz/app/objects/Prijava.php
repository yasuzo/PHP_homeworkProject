<?php

require_once '/app/src/dz/app/validation_helpers.php';

// define('BAZA', '../data/baza.json');

class Prijava implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{

        $messages = [];
        $post = $request->post();
        $get = $request->get();

        if($request->method() === 'GET' && $request->httpReferer() !== null){
            $this->session->setSessionProperty('lastPage', $request->httpReferer());
        }

        if(isset($get['odjavi-me']) && $request->method() === 'POST'){
            $this->session->logout();
            header('Location: index.php');
            die();
        }

        if($this->session->isAuthenticated()){
            header('Location: '.($this->session->getSessionProperty('lastPage') ?? 'index.php'));
            die();
        }


        if($request->method() === 'POST'){
            $username = $post['username'] ?? '';
            $password = $post['password'] ?? '';
            if(passed_value_is_array($username, $password)){
                $messages[] = "Greska - Poslan je array!";
            }else{
                if(credentials_ok($username, $password, BAZA)){
                    $this->session->setSessionProperty('user', $username);
                    header('Location: '.($this->session->getSessionProperty('lastPage') ?? 'index.php'));
                    die();
                }else{
                    $messages[] = "Username ili password nije ispravan!";
                }
            }
        }

        echo $this->templatingEngine->render(
            'layouts/layout.php', 
            [ 
                'title' => 'Prijava',
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render(
                    'prijava_template.php', 
                    [
                        'messages' => $messages
                    ]
                )
            ]
        );
    }
}

