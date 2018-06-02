<?php


require_once '/app/src/dz/app/validation_helpers.php';

class Registracija implements Controller{
    private $userRepository;
    private $templatingEngine;
    private $session;

    public function __construct(Templating $engine, Session $session, UserRepository $repository){
        $this->templatingEngine = $engine;
        $this->userRepository = $repository;
        $this->session = $session;
    }

    public function handle(Request $request): void{
        $messages = [];
        $post = $request->post();

        if($this->session->isAuthenticated()){
            header('Location: index.php');
            die();
        }
        if($request->method() === 'POST'){
            $username = $post['username'] ?? '';
            $pass1 = $post['pass1'] ?? '';
            $pass2 = $post['pass2'] ?? '';

            $errors = [];

            if(passed_value_is_array($username, $pass1, $pass2)){
                $messages[] = "Greska - Poslan je array!";
                set_empty_string($username, $pass1, $pass2);
            }else{
                validate_username($username, $errors);
                validate_passwords($pass1, $pass2, $errors);
                username_taken($username, BAZA, $errors);
                if(empty($errors) === false){
                    foreach($errors as $val){
                        $messages[] = $val;
                    }
                }else{
                    $pass1 = password_hash($pass1, PASSWORD_BCRYPT);
                    $this->userRepository->persist(new User($username, $pass1));
                    $this->session->setSessionProperty('user', $username);
                    header('Location: index.php');
                    die();
                }
            }
        }

        echo $this->templatingEngine->render(
            'layouts/layout.php', 
            [ 
                'title' => 'Registracija',
                'authenticated' => $this->session->isAuthenticated(),
                'body' => $this->templatingEngine->render(
                    'registracija_template.php', 
                    [ 
                        'messages' => $messages,
                    ]
                )
            ]
        );
    }
}
