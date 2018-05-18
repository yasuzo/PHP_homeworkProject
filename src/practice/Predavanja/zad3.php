<?php

declare(strict_types=1);

class Formater{
    public function formatiraj(string $ulaz): string{
        return '<strong>'.$ulaz.'</strong>';
    }
}

class NewFormater extends Formater{


    public function formatiraj(string $ulaz): string{
        $ulaz = parent::formatiraj($ulaz);
        return '<i>'.$ulaz.'</i>';
    }
}

class Editor{
    private $formater;
    public function __construct(Formater $formater){
        $this->formater = $formater; 
    }

    public function uredi(string ...$redovi): string{
        $noviRedovi = array_map(function(string $string): string{
            return $this->formater->formatiraj($string);
        }, $redovi);
        return implode('<br>', $noviRedovi);
    }
}

$object1 = new Formater();

$object2 = new NewFormater();

$editor = new Editor($object1);
echo $editor->uredi('ovo je bold!', 'blabla');

echo '<br>';


$editor->__construct($object2);
echo $editor->uredi('ovo je bold!', 'blabla');