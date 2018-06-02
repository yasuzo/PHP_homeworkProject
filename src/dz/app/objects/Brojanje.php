<?php
require_once "/app/src/dz/app/funkcije.php";

class Brojanje implements Controller{
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session){
        $this->templatingEngine = $engine;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        $show = true;
        $get = $request->get();

        $ulaz = $get['ulaz'] ?? '';
        $trazi = $get['trazi'] ?? '';
        $broji = $get['broji'] ?? '';

        $messages = [];


        // provjera je li bilo koji od ulaznih parametara proslijedjen kao array
        if(passed_value_is_array($ulaz, $trazi, $broji)){
            $messages[] = "Greska - pokusavate poslati array!";
            $ulaz = '';
            $trazi = '';
            $broji = '';
        }else if(isset($get['submitButton'])){
            $broji = explode(',', $broji);
            if(($rez = ponavljanje($ulaz, $trazi, ...$broji)) !== -1){
                // ako nema greske
                $messages[] = $rez;
                $show = false;
            }else{
                if(is_empty($trazi, $broji = implode(',',$broji)))
                    $messages[] = "Greska - parametri su prazni!";
                else if(longer_than_one($trazi))
                    $messages[] = "Greska - parametar Trazi ima vise od jednog znaka!";
                else
                    $messages[] = "Greska - elementi u parametru broji moraju biti duljine jednog znaka!";
            }
        }

        echo $this->templatingEngine->render(
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
    }
}

