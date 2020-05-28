<?php
/**
 *
 * @framework: Ksike
 * @package: config
 * @subpackage: driver
 * @version: 0.1
 * @description: ConfigDriverJSON es una libreria para el trabajo con ...
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 15/06/2010
 * @update-Date: 20/12/2010
 * @license: GPL v2
 *
 */
class ConfigDriverJSON extends ConfigDriver
{
	private $source;
	public function __construct($path="") 
	{ 
		parent::__construct($path); 
		$this->source = 0;
		$this->name = 'json';
	}
	public function load($path=0, $force=0, $analyzer=null)
	{
		$path = $path ? $path : $this->file;
		if(!$this->source || $force) $this->source = file_get_contents($path);
		$this->source = $this->onConfigPerform($this->source, $analyzer);
		echo json_encode([ "path" => __DIR__ ]);
		//var_dump(json_decode(json_encode([ "path" => __DIR__ ]), true ));
		var_dump(json_decode("{'path':'D:\bin\xampp-7030\htdocs\dev\webcp.bycod\portal\lib\bycod\lib\config\src\server\driver'}", true));
		//var_dump(json_decode('{"path":"D:\\bin\\xampp-7030\\htdocs\\dev\\webcp.bycod\\portal\\lib\\bycod\\lib\\config\\src\\server\\driver"}', true));
	    //var_dump(json_decode('{ "import": "bycod", "idiom":"en", "mail":{ "host":"srq-cc.com", "username":"reservastucita", "password":"010414", "phone":"+53 52124535", "from":"admin.red@cfg.labiofam.cu", "fromname":"Administrador", "driver":"mail" }, "db":{ "log":"log/", "driver":"sqlite", "name":"storage", "path":"__DIR__/data/db/", "extension":"db" }, "media":{ "url":"http://videoteca.cfg.labiofam.cu/emby/", "imp":["informatica/nube/Cuntos_megas_de_Internet_necesito","labiofam/20190513-Consejo"], "tips":{ "total":114 } }, "company":{ "field":"p.role", "role":"user", "phone":"+53 52124535", "email":"admin.red@cfg.labiofam.cu" }, "ftp":{ "server":"ftp.cfg.labiofam.cu", "deep":"5", "match":"all" } }', true));
		//var_dump(json_decode('{ "import": "bycod", "idiom":"en", "mail":{ "host":"srq-cc.com", "username":"reservastucita", "password":"010414", "phone":"+53 52124535", "from":"admin.red@cfg.labiofam.cu", "fromname":"Administrador", "driver":"mail" }, "db":{ "log":"log/", "driver":"sqlite", "name":"storage", "path":"D:\\bin\\xampp-7030\\htdocs\\dev\\webcp.bycod\\portal/data/db/", "extension":"db" }, "media":{ "url":"http://videoteca.cfg.labiofam.cu/emby/", "imp":["informatica/nube/Cuntos_megas_de_Internet_necesito","labiofam/20190513-Consejo"], "tips":{ "total":114 } }, "company":{ "field":"p.role", "role":"user", "phone":"+53 52124535", "email":"admin.red@cfg.labiofam.cu" }, "ftp":{ "server":"ftp.cfg.labiofam.cu", "deep":"5", "match":"all" } }', true));
		$this->source = json_decode($this->source, true);
		return $this->source;
	}
	public function save($data=0, $path=0)
	{
		$path = $path ? $path : $this->file;
		$data = $data ? $data : $this->source;
		file_put_contents($path, stripcslashes(json_encode($data)));
	}

}
