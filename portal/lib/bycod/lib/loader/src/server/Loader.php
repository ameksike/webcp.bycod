<?php
/*
 * @framework: Bycod
 * @package: Front
 * @version: 0.1
 * @description: This is simple and fight front engine
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
	class Loader
    {
        public function onConfig($assist){
            include __DIR__ . "/../../../carrier/src/Main.php";
            Carrier::active($this->assist->cfg['bycod']['loader']);
		}
    }