<?php
    //$config['bycod']['engine']['links']['onStart'][] = '';
    //$config['bycod']['engine']['links']['onStop'][] = '';
    //$config['bycod']['engine']['links']['onError'][] = '';
    //$config['bycod']['engine']['links']['onException'][] = '';

    $config['bycod']['engine']['links']['onConfig'][] = 'loader';
    //$config['bycod']['engine']['links']['onConfig'][] = 'rbac';
    $config['bycod']['engine']['links']['onRequest'][] = 'request';
    $config['bycod']['engine']['links']['onDispatch'][] = 'front';
    $config['bycod']['engine']['links']['onRender'][] = 'view';
    $config['bycod']['engine']['links']['onResponse'][] = 'response';

    $config['bycod']['engine']['workflow'][] = 'onStart';
    $config['bycod']['engine']['workflow'][] = 'onRequest';
    $config['bycod']['engine']['workflow'][] = 'onAccess';
    $config['bycod']['engine']['workflow'][] = 'onDispatch';
    $config['bycod']['engine']['workflow'][] = 'onRender';
    $config['bycod']['engine']['workflow'][] = 'onResponse';
    $config['bycod']['engine']['workflow'][] = 'onStop';

    $config['bycod']['view']['tpl']["html"] = "/src/client/html/";
    $config['bycod']['view']['tpl']["php"]  = "/src/server/tpl/";

    $config['bycod']['porter']['user'] = "guest";
    $config['bycod']['porter']['pass'] = "";
    $config['bycod']['porter']['role'] = "guest";
    $config['bycod']['porter']['acl']  = "default";

	$config['bycod']['router']['path'] = '';
	$config['bycod']['router']['delimiter']["windows"] = "\\";
	$config['bycod']['router']['delimiter']["linux"] = "/";
	$config['bycod']['router']['delimiter']["scheme"] = "/";
	$config['bycod']['router']['delimiter']["pretty"] = "/";
	$config['bycod']['router']['delimiter']["cli"] = ":";
	$config['bycod']['router']['pattern']["default"] = ["idiom", "controller", "action"];
	
	$config['bycod']['request']['model'] = "list";   
	$config['bycod']['request']['type'] = "auto";
	$config['bycod']['request']['option']['scheme'] = "portal/index";
    $config['bycod']['request']['option']['controller'] = "portal";
    $config['bycod']['request']['option']['action'] = "index";

    $config['bycod']['loader']['Ksike'] =  __DIR__ .'/../lib/bycod/lib/';

    return $config;