<?php
require_once '/app/src/dz/app/normalizer.php';

class Normaliziraj implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        $messages = [];
        $post = $request->post();

        if($this->session->isAuthenticated() === false){
            header('Location: index.php?controller=prijava');
            die();
        }
        $showForm = true;

        if($request->method() === 'POST'){
            $ulaz = $post['ulaz'] ?? '';
            if(is_array($ulaz)){
                $messages[] = "Greska - poslan je array!";
            }else{
                $showForm = false;
                $count = normalize($ulaz);
            }
        }

        echo $this->templatingEngine->render(
            'layouts/layout.php', 
            [ 
                'title' => 'Normaliziraj',
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render(
                    'normaliziraj_template.php', 
                    [
                        'messages' => $messages, 
                        'output' => $ulaz ?? '', 
                        'count' => $count ?? '', 
                        'show' => $showForm
                    ]
                )
            ]
        );
    }
}




