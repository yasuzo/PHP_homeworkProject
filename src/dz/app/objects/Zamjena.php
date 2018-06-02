<?php

require_once "/app/src/dz/app/funkcije.php";

class Zamjena implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): Response{
        $show = true;
        $files = $request->files();

        $messages = [];

        try{
            if($request->method() === 'POST'){
                if(isset($files['ulaz']) && UPLOAD_ERR_OK === $files['ulaz']['error']){
                    if($files['ulaz']['size'] > 1024){
                        throw new FileTooLargeException('Greska - Datoteka prevelika!');
                    }
                    $file = $files['ulaz'];
                    if(($data=file_get_contents($file['tmp_name'])) === false){
                        throw new UnableToOpenStreamException('Greska - Nije moguce procitati datoteku!');
                    }
                    $data = transformiraj($data);
                    $show = false;
                }
            }
        }catch(Exception $e){
            $messages[] = $e->getMessage();
        }

        if($show){
            $content = $this->templatingEngine->render('layouts/layout.php',
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
            return new HTMLResponse($content);
        }else{
            $content = $this->templatingEngine->render('zamjena_template.php', ['title' => 'Zamjena', 'show' => $show, 'data' => $data]);
            return new AttachmentResponse('transformirani.html', $content, 'application/html');
        }
    }
}
