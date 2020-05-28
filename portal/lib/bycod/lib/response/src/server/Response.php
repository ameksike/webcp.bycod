<?php
/*
 * @framework: Bycod
 * @package: Response
 * @version: 0.1
 * @description: This is simple and light response lib
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Response
{
    public function onResponse($assist){
        $driver = $this->identify($assist->cfg['bycod']["response"]);
        $assist->cfg['bycod']["response"]['data'] =  $this->compile($assist->cfg['bycod']["response"]['data'], $driver);
    }

    protected function identify($option){
        return isset($option["type"]) ? strtoupper($option["type"]) : strtoupper($this->getAccept());
    }
    protected function getAccept(){
        $_SERVER['HTTP_ACCEPT'] = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : 'json';
        switch($_SERVER['HTTP_ACCEPT']){
            case 'text/html':
            case 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8':
            case 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8': return 'html'; break;
            case 'image/png,image/*;q=0.8,*/*;q=0.5':
            case 'image/webp,*/*;q=0.8': return 'img'; break;
            default: return $_SERVER['HTTP_ACCEPT']; break;
        }
    }
    protected function getDriver($driver){
        include_once dirname(__FILE__)."/driver/OutDriver.php";
        $driver = "OutDriver$driver";
        $file = dirname(__FILE__)."/driver/$driver.php";
        if(file_exists($file)){
            include_once $file;
            return new $driver;
        }return false;
    }
    protected function compile($data, $driver){
        $driver = $this->getDriver($driver);
        return $driver ? $driver->getOut($data) : print_r($data, true);
    }
}