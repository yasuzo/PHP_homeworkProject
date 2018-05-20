<?php

declare(strict_types=1);

interface Formater{
    public function formatiraj(string $ulaz): string;
}

class CompositeFormater implements Formater{
    private $formateri;

    public function __construct(array $format){
        foreach($format as $el){
            $formateri[] = $el;
        }
    }

    public function formatiraj(string $ulaz): string {
        foreach($foramteri as $formater){
            $ulaz = $formater->formatiraj($ulaz);
        }

        return $ulaz;
    }
}

class StrongFormater implements Formater{
    public function formatiraj(string $ulaz): string{
        return '<strong>'.$ulaz.'</strong>';
    }
}

class ItalicsFormater implements Formater{
    public function formatiraj(string $ulaz): string{
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

$object2 = new ItalicsFormater();

$editor = new Editor($object1);
echo $editor->uredi('ovo je bold!', 'blabla');

echo '<br>';


$editor->__construct($object2);
echo $editor->uredi('ovo je bold!', 'blabla');