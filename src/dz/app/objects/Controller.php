<?php

interface Controller{
    public function handle(Request $request): void;
}