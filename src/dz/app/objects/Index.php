<?php

class Index implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        echo $this->templatingEngine->render(
            'layouts/layout.php', 
            [ 
                'title' => 'Index',
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render('index_template.php', [])
            ]
        );
    }
}