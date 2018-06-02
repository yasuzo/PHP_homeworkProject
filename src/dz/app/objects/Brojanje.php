<?php
require_once "/app/src/dz/app/funkcije.php";

class Brojanje implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): Response{
        $show = true;
        $get = $request->get();

        $ulaz = $get['ulaz'] ?? '';
        $trazi = $get['trazi'] ?? '';
        $broji = $get['broji'] ?? '';

        $messages = [];

        try{
            if(passed_value_is_array($ulaz, $trazi, $broji)){
                throw new RuntimeException('Greska - Poslan array!');
            }
            if(isset($get['submitButton'])){
                $broji = explode(',', $broji);
                $rez = ponavljanje($ulaz, $trazi, ...$broji);
                $messages[] = $rez;
                $show = false;
            }
        }catch(InvalidArgumentValueException $e){
            $messages[] = $e->getMessage();
            $broji = implode(',', $broji);
        }catch(RuntimeException $e){
            $messages[] = $e->getMessage();
            set_empty_string($broji, $ulaz, $trazi);
        }

        $content = $this->templatingEngine->render(
            'layouts/layout.php', 
            [ 
                'title' => 'Brojanje', 
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render(
                    'brojanje_template.php', 
                    [ 
                        'messages' => $messages,
                        'show' => $show,
                        'ulaz' => $ulaz, 
                        'trazi' => $trazi, 
                        'broji' => $broji
                    ]
                )
            ]
        );

        return new HTMLResponse($content);
    }
}

