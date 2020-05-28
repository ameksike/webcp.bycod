<?php
/*
 * @framework: Bycod
 * @package: View
 * @version: 0.1
 * @description: This is simple and light error manager
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*, porter, role, user, officer
 */
class KsError
{
    static $assists;
    public function onConfig($assist){
        self::$assists = $assist;
        error_reporting(E_ALL);
        set_error_handler("KsError::onError");
        set_exception_handler("KsError::onException");
    }
    static public function onError($errno, $errstr, $errfile, $errline){
        $log = date('Y/m/d-H:i:s')." >> $errno: $errstr >> line: $errline >> file: $errfile  \n";
        error_log($log, 3, self::$assists->cfg['bycod']['router']['path'].'/log/error.log');
        self::$assists->event->emit('onError', array($errno, $errstr, $errfile, $errline));
    }
    static public function onException($exc){
        $log = date('Y/m/d H:i:s')." >> {$exc->getMessage()}  \n";
        error_log($log, 3, self::$assists->cfg['bycod']['router']['path'].'/log/exception.log');
        self::$assists->event->emit('onException', $exc);
    }
}