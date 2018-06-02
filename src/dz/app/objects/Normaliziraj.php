<?php
require_once '/app/src/dz/app/normalizer.php';

class Normaliziraj implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): Response{
        $messages = [];
        $post = $request->post();

        if($this->session->isAuthenticated() === false){
            return new RedirectResponse('index.php?controller=prijava');
        }
        $showForm = true;

        if($request->method() === 'POST'){
            $ulaz = $post['ulaz'] ?? '';
            try{
                $count = normalize($ulaz);
                $showForm = false;
            }catch(TypeError $e){
                $messages[] = "Greska - poslan je array!";
            }
        }

        $content = $this->templatingEngine->render(
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

        return new HTMLResponse($content);
    }
}




