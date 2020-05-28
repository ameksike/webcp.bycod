<?php
/*
 * @version: 0.1
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/12/2019
 * @update: 23/12/2019
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
use Ksike\lcftp\src\server\Main as LcFtp;

class Store
{
    public function __construct(){
        $this->view = ':';
    }

    public function index(){
        $this->view = 'theme:debug/news';
        return array(
            "active"=>"news"
        );
    }

    public function load($request){
       /* 
        $key = '';
        if(isset($_REQUEST['search']['value']))
            $key = $_REQUEST['search']['value'];
        $deep = $key == '' ? 1 : 5;

        $obj = new LcFtp($config['ftp']);
        $out = $obj->find($key, '/', $deep);
        $tot = count($out);
        $ous = array_slice($out, $_REQUEST['start'], $_REQUEST['length']);
        return array(
            "data"            => $ous,
            "draw"            => $_REQUEST['draw'],
            "recordsFiltered" => $tot,
            "recordsTotal"    => $tot,
        );*/
    }
    
} 
