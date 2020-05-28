<?php
/**
 *
 * @framework: Bycod
 * @package: request
 * @version: 0.1
 * @description: InDriver es una libreria para el trabajo con los formatos de entrada del servidor
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v2
 *
 */
class InDriver{
    protected $tool;

    public function __construct($tool){	
        $this->tool =  $tool;
    }
    public function process($request, $router){
        return null;
    }
}