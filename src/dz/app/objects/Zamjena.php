<?php

require_once "/app/src/dz/app/funkcije.php";

class Zamjena implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        $show = true;
        $files = $request->files();

        $messages = [];

        if($request->method() === 'POST'){
            if(isset($files['ulaz']) && UPLOAD_ERR_OK === $files['ulaz']['error']){
                if($files['ulaz']['size'] > 1024){
                    $messages[] = "Greska - datoteka prevelika!";
                }else{
                    $file = $files['ulaz'];
                    if(($data=file_get_contents($file['tmp_name'])) === false)
                        $messages[] = "Greska - nije moguće pročitati sadržaj datoteke!";
                    else if(($data = transformiraj($data)) === null)
                        $messages[] = "Greska - svi tagovi u datoteci moraju biti zatvoreni i moraju se zatvarati suprotno od onoga kako su se otvarali!";
                    else{
                        $show = false;
                        header("Content-Type: application/html");
                        header("Content-Disposition: attachment; filename='transformirani.html'");
                    }
                }
            }
        }

        if($show){
            echo $this->templatingEngine->render('layouts/layout.php',
                [
                    'title' => 'Zamjena',
                    'authenticated' => $this->session->isAuthenticated(),
                    'body' => $this->templatingEngine->render('zamjena_template.php',
                        [
                            'show' => $show,
                            'messages' => $messages
                        ]
                    )
                ]
            );
        }else{
            echo $this->templatingEngine->render('zamjena_template.php', ['title' => 'Zamjena', 'show' => $show, 'data' => $data]);
        }
    }
}
