<?php

require_once '/app/src/dz/app/validation_helpers.php';

// define('BAZA', '../data/baza.json');

class Prijava implements Controller{
    private $templatingEngine;
    private $session;
    private $userRepository;

    public function __construct(Templating $engine, Session $session, UserRepository $userRepository){
        $this->templatingEngine = $engine;
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request): Response{

        $messages = [];
        $post = $request->post();
        $get = $request->get();

        if($request->method() === 'GET' && $request->httpReferer() !== null){
            $this->session->setSessionProperty('lastPage', $request->httpReferer());
        }

        if(isset($get['odjavi-me']) && $request->method() === 'POST'){
            $this->session->logout();
            return new RedirectResponse('index.php');
        }

        if($this->session->isAuthenticated()){
            return new RedirectResponse($this->session->getSessionProperty('lastPage') ?? 'index.php');
        }

        try{
            if($request->method() === 'POST'){
                $username = $post['username'] ?? '';
                $password = $post['password'] ?? '';
                if(passed_value_is_array($username, $password)){
                    throw new RuntimeException('Greska - Poslan je array!');
                }
                if($this->userRepository->credentialsOK($username, $password)){
                    $this->session->setSessionProperty('user', $username);
                    header('Location: '.($this->session->getSessionProperty('lastPage') ?? 'index.php'));
                    die();
                }else{
                    $messages[] = "Username ili password nije ispravan!";
                }
            }
        }catch(Exception $e){
            $messages[] = $e->getMessage();
        }

        $content = $this->templatingEngine->render(
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

        return new HTMLResponse($content);
    }
}

