<?php
    /*
     *
     * @framework: Bycod
     * @package: web
     * @version: 0.1
     * @description: This is simple and Light CLI single frontal access under HTTP
     * @authors: ing. Antonio Membrides Espinosa
     * @mail: tonykssa@gmail.com
     * @made: 15/06/2012
     * @update: 15/06/2012
     * @license: GPL v3
     * @require: PHP >= 5.2.*
     *
     */
	include 'lib/bycod/src/server/Bycod.php';
    $config['bycod']['router']['path'] = dirname(__FILE__);
    echo Bycod::lib("engine")->setting($config)->process();
	//Bycod::this()->log(get_included_files());