<?php

require_once "/app/src/dz/app/funkcije.php";

class Zbrajanje implements Controller {
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): Response{
        $messages = [];
        $get = $request->get();

        $show = true;
        $ulaz = $get['ulaz'] ?? '';

        try{
            if(passed_value_is_array($ulaz)){
                throw new TypeError();
            }
            if(isset($get['submitButton'])){
                $rez = zbroji($ulaz);
                $messages[] = $rez;
                $show = false;
            }
        }catch(TypeError $e){
            $ulaz = '';
            $messages[] = "Greska - proslijeđen je array!";
        }catch(InvalidArgumentValueException $e){
            $messages[] = $e->getMessage();
        }

        $content = $this->templatingEngine->render('layouts/layout.php',
            [
                'title' => 'Zbrajanje',
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render('zbrajanje_template.php',
                    [
                        'show' => $show,
                        'messages' => $messages,
                        'ulaz' => $ulaz
                    ]
                )
            ]
        );

        return new HTMLResponse($content);
    }
}


