<?php
    $config = include dirname(__FILE__).'/bycod.php';   //... separar la configuracin del framework

    
    $config['idiom']            = 'en';
	$config["mail"]["host"]		= "srq-cc.com"; 		//... servidor o proveedor de correo
	$config["mail"]["username"]	= "reservastucita";		//... campo de usuario de una cuenta activa en el servidor de correo
	$config["mail"]["password"]	= "010414";				
	$config["mail"]["phone"]	= "+53 52124535";	
	$config["mail"]["from"]		= "admin.red@cfg.labiofam.cu";	
	$config["mail"]["fromname"]	= "Administrador";				//... alias o sobre nombre para el que emite el correo
	$config["mail"]["driver"]	= "mail";

    $config['db']["log"]		= __DIR__ . "/../log/";
    $config['db']["driver"]	 	= "sqlite";					        //... valores admitidos: pgsql|mysql|mysqli|sqlite|sqlsrv
    $config['db']["name"]		= "storage";		              	//... nombre de la base de datos a la cual debe conectarse  
    $config['db']["path"]		= __DIR__ . "/../data/db/";	  		//... ruta donde se encuentra la base de datos
    $config['db']["extension"]  = "db";		
    $config['db']["debug"]      = "vervose";						//... default value db

    $config['media']['url'] = "http://videoteca.cfg.labiofam.cu/emby/";
    $config['media']['imp'][] = "informatica/nube/Cuntos_megas_de_Internet_necesito";
    $config['media']['imp'][] = "labiofam/20190513-Consejo";
    $config['media']['tips']['total'] = 114;

    $config['company']['field'] = "p.role";
    $config['company']['role']  = "user";
	$config["company"]["phone"]	= "+53 52124535";
	$config["company"]["email"]	= "admin.red@cfg.labiofam.cu";

    $config['ftp']['server'] = 'ftp.cfg.labiofam.cu';
    $config['ftp']['deep'] = '5';
    $config['ftp']['match'] = 'all';
    

	return $config;
