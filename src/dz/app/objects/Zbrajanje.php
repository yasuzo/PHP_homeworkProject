<?php

require_once "/app/src/dz/app/funkcije.php";

class Zbrajanje implements Controller {
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        $messages = [];
        $get = $request->get();

        $show = true;
        $ulaz = $get['ulaz'] ?? '';

        if(passed_value_is_array($ulaz)){
            $ulaz = "";
            $messages[] = "Greska - proslijeđen je array!";
        }else if(isset($get['submitButton'])){
            if(($rez = zbroji($ulaz)) !== -1){
                $messages[] = $rez;
                $show = false;
            }else if(empty($ulaz))
                $messages[] = "Greska - ulazni parametar je prazan!";
            else
                $messages[] = "Greska - broj mora biti >= 0 i cijeli, bez ikakvih posebnih znakova!";
        }

        echo $this->templatingEngine->render('layouts/layout.php',
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
    }
}


