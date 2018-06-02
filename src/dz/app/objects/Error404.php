<?php

class Error404 implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): Response{
        $content = $this->templatingEngine->render('layouts/layout.php', [
            'title' => '404',
            'authenticated' => $this->session->isAuthenticated(),
            'body' => $this->templatingEngine->render('404_template.php', [])
        ]);

        return new HTMLResponse($content);
    }
}