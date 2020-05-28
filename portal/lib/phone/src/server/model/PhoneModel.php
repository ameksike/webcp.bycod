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
use Ksike\lql\lib\customise\lqls\src\Main as LQL;

class PhoneModel
{
    public $config;
    public $table;

    public function __construct($cfg){
        $this->config = $cfg;
        $this->table = 'phonebook';
    }
    

    public function select($request){
        $id = !$request ? '' :  isset($request['id']) ? $request['id'] : ((isset($request['params'][0])) ? $request['params'][0]: '') ;
        $limit = !$request ? '' :  isset($request['limit']) ? $request['limit'] : 10;
        $offset = !$request ? '' :  isset($request['offset']) ? $request['offset'] : 0;

        $qm = LQL::create($this->config['db'])
            ->select('*')
            ->from($this->table, 'p')
        ;

        $qm  = $qm->limit($limit)->offset($offset);
        $out = $qm->execute();
        $out = !$out ? array() : $out;

        return array("data"=> $out, "total"=>$this->total(), 'limit'=>$limit, 'offset'=>$offset );

        return $out;
    }

    public function total(){
        $total = LQL::create($this->config['db'])
            ->select('count(id) as total')
            ->from($this->table, 'p')
            ->execute();
        return $total[0]['total'];
    }

}