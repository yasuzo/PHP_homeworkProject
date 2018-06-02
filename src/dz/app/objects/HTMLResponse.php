<?php

class HTMLResponse implements Response {
    private $html;

    public function __construct(string $html){
        $this->html = $html;
    }

    public function send(): void {
        echo $this->html;
    }
}