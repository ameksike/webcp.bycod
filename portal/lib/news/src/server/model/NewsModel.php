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

        $id = !$request ? '' :  isset($request['id']) ? $request['id'] : '' ;
        //$id = !$request ? '' :  isset($request['id']) ? $request['id'] : ((isset($request['params'][0])) ? $request['params'][0]: '') ;

        $limit = !$request ? '' :  isset($request['limit']) ? $request['limit'] : 9;
        $offset = !$request ? '' :  isset($request['offset']) ? $request['offset'] : 0;
        $filter = null;
        
        if(isset($request['search']['value'])){
            $filter = LQL::create()
            ->addWhere('a.title', '%'. $request['search']['value'] .'%', 'like')
            ->orWhere('a.sumary', '%'. $request['search']['value'] .'%', 'like')
            ->orWhere('a.description', '%'. $request['search']['value'] .'%', 'like')
            ->orWhere('a.author', '%'. $request['search']['value'] .'%', 'like');
        } 
        
        $qm = LQL::create($this->config['db'])
            ->from('article', 'a')
            ->orderBy('a.date', 'DESC')
        ;

        if(!empty($id)){
            $qm = $qm->where("id", $id);
            $qm =  $filter ? $qm->andWhere($filter) : $qm ;
            
        }else if($normal){
            $qm  = $qm->where('a.status', 'normal');
            $qm =  $filter ? $qm->andWhere($filter) : $qm ;
        }else{
            $qm =  $filter ? $qm->where($filter) : $qm ;
        }

        $qm  = $qm->limit($limit)->offset($offset);

        $out = $qm->select('*')->execute();
        $out = !$out ? array() : $out;
        $total = empty($id) ? $this->total($filter) : 1;

        return array('total'=>$total, 'data'=>$out, 'limit'=>$limit, 'offset'=>$offset  );
    }

    public function relevant(){
        $rel = LQL::create($this->config['db'])->select('*')->from('article', 'a')->where('a.status', 'relevant')->orderBy('a.date', 'DESC')->limit(2)->execute();
        return $rel;
    }
    public function total($filter=null){
        $qm = LQL::create($this->config['db'])->select('count(id) as total')->from('article', 'a');
        $qm =  $filter ? $qm->where($filter) : $qm ;
        $total =  $qm ->execute();
        return $total[0]['total'];
    }
    public function save($obj){
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
        $id = isset($request['id']) ? $request['id'] : '' ;
        
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
            'url'=> '',
            'sumary'=> '',
            'description'=> ''
        ];
    }

} 
