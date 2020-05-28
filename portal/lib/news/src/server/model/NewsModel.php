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

class NewsModel
{
    public $config;
    public function __construct($cfg){
        $this->config = $cfg;
    }

    public function last(){
        $lst = LQL::create($this->config['db'])->select('*')->from('article', 'a')->orderBy('a.date', 'DESC')->limit(3)->execute();
        return $lst;
    }

    public function get($request=false, $normal=false){

        //$id = !$request ? '' :  isset($request['id']) ? $request['id'] : $request['param'] ;
        $id = !$request ? '' :  isset($request['id']) ? $request['id'] : ((isset($request['params'][0])) ? $request['params'][0]: '') ;

        $limit = !$request ? '' :  isset($request['limit']) ? $request['limit'] : 9;
        $offset = !$request ? '' :  isset($request['offset']) ? $request['offset'] : 0;
        
        $qm = LQL::create($this->config['db'])
            ->from('article', 'a')
            ->orderBy('a.date', 'DESC')
        ;
        if(!empty($id)){
            $qm  = $qm->where("id", $id);
        }else if($normal){
            $qm  = $qm->where('a.status', 'normal');
        }
        
        $qm  = $qm->limit($limit)->offset($offset);

        $out = $qm->select('*')->execute();
        $out = !$out ? array() : $out;
        $total = empty($id) ? $this->total() : 1;

        return array('total'=>$total, 'data'=>$out, 'limit'=>$limit, 'offset'=>$offset  );
    }

    public function relevant(){
        
        $rel = LQL::create($this->config['db'])->select('*')->from('article', 'a')->where('a.status', 'relevant')->orderBy('a.date', 'DESC')->limit(2)->execute();
        return $rel;
    }
    public function total(){
        $total = LQL::create($this->config['db'])->select('count(id) as total')->from('article', 'a')->execute();
        return $total[0]['total'];
    }
    public function save($request){
        $id = isset($request['id']) ? $request['id'] : $request['param'] ;
        $obj = $request;
        unset($obj['btnSafe'], $obj['art'], $obj['type']);

        if($obj['id']!='') {
            $qm = LQL::create($this->config['db'])
                ->update('article')
                ->set( array_keys($obj), array_values($obj))
                //['title', 'sumary', 'description', 'date', 'author', 'imgico',  'imgfront',  'url', 'status'], 
                //[$obj['title'],$obj['sumary'],$obj['description'],$obj['date'],$obj['imgico'],$obj['imgfront'],$obj['url'],$obj['status'],$obj['status'],]
                ->where('id', $obj['id'])
                ->execute();
            ;
        }else{
            $sql = LQL::create($this->config['db'])
                ->insert('article')
                ->into('title', 'sumary', 'description', 'date', 'author', 'imgico',  'imgfront',  'url', 'status')
                ->values($obj['title'],$obj['sumary'],$obj['description'],$obj['date'],$obj['author'],$obj['imgico'],$obj['imgfront'],$obj['url'],$obj['status'])
                ->execute()
            ;
        }
    }
    
    public function delete($request){
        $id = isset($request['id']) ? $request['id'] : $request['param'] ;
        
        if(!empty($id)) {
            $qm = LQL::create($this->config['db'])
                ->delete('article')
                ->where('id', $id)
                ->execute();
            ;
        }
    }

    public function  empty(){
        return [
            'id'=> '',
            'title'=> '',
            'date'=> '',
            'author'=>'',
            'status'=> true,
            'imgico'=> '',
            'imgfront'=> '',
            'sumary'=> '',
            'description'=> ''
        ];
    }

} 
