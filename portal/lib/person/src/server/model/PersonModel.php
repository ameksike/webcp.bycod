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

class PersonModel
{
    public $config;

    public function __construct($cfg){
        $this->config = $cfg;
    }

    public function getFilter($request, $prefix){
        $filter = LQL::create();
        $init = 0;
        if(!isset($request['search']['value']) || !isset($request['columns']) ) return null;
        foreach($request['columns'] as $i){
            $i['data'] = $i['data']=="avatar" ? "img" : $i['data'];
            if($i['searchable'] && !empty($i['data']) ){
                if($init++ == 0){
                    $filter = $filter->addWhere($prefix. $i['data'], '%'. $request['search']['value'] .'%', 'like');
                }else{
                    $filter = $filter->orWhere($prefix. $i['data'], '%'. $request['search']['value'] .'%', 'like');
                }
               
            }
        }
        return $filter;
    }
    public function list($request){
        
        $filter = $this->getFilter($request, "p.");
        
        LQL::setting($this->config['db']);

        $qm = LQL::create()
            ->select('*')
            ->from('person', 'p')
            ->where($this->config['company']['field'], $this->config['company']['role'])
        ;

        $qm =  $filter ? $qm->andWhere($filter) : $qm ;
        $limit = !$request ? '' :  isset($request['limit']) ? $request['limit'] : 10;
        $offset = !$request ? '' :  isset($request['offset']) ? $request['offset'] : 0;
        $qm  = $qm->limit($limit)->offset($offset);
        $out = $qm->execute();

        $out = !$out ? array() : $out;
        return array("data"=> $out, "total"=>$this->total($filter), 'limit'=>$limit, 'offset'=>$offset );
    }

    public function save($request){
        /*
                ci, alias, firstname, lastname, user, domain, role, password, datein, dateout, sex, place,
                company, position, profession, category, note, city, town, address, img
        */
    }

    public function total($filter=null){
        $qm =  LQL::create()
            ->select('count(id) as total')
            ->from('person', 'p')
            ->where($this->config['company']['field'], $this->config['company']['role'])
        ;
        $qm = $filter ? $qm->andWhere($filter) : $qm ;
        $total = $qm ->execute();
        return $total[0]['total'];
    }
    public function get($request){
        $id = isset($request['id']) ? $request['id'] : '' ;

        $out = [];
        
        if(!empty($id)){
            $out["person"] = LQL::create($this->config['db'])
                ->select('*')
                ->from('person', 'p')
                ->where('id', $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->execute()
            ;
            $out["trait"] = LQL::create($this->config['db'])
                ->select("*")
                ->from('trait', 't')
                ->innerJoin("traituser tu", ' tu.trait', "t.id")
                ->innerJoin("person p", ' tu.owner', "p.id")
                ->where("p.id", $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->execute()
            ;
            $out["phonebook"] = LQL::create($this->config['db'])
                ->select("*")
                ->from('phonebook', 'g')
                ->innerJoin("phoneuser pu", ' pu.phone', "g.id")
                ->innerJoin("person p", ' pu.user', "p.id")
                ->where("p.id", $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->execute()
            ;
        }
        $out = !$out ? array() : $out;

        if(isset($out["person"])){
            $out["person"][0]['avatar'] = "data/user/". strtolower($out["person"][0]['company'])."/". strtolower($out["person"][0]['user']) . ".jpg";
            if(!file_exists(__DIR__ . "/../"  . $out["person"][0]['avatar']))
                $out["person"][0]['avatar'] = "data/user/user_".$out["person"][0]['sex'].".svg";

            $out["person"][0]['company'] =  $out["person"][0]['company'] == 'Other' ? "" : $out["person"][0]['company'];
            $out["person"][0]['domain']  =  ($out["person"][0]['company'] === "") ? "" : $out["person"][0]['domain'] ;
            $out["person"][0]['email']   =  ($out["person"][0]['company'] === "") ? "" : $out["person"][0]['user'] . "@" . $out["person"][0]['domain'] ;
            $out["person"][0]['chat']    =  ($out["person"][0]['company'] === "") ? "" : $out["person"][0]['user'] . "@jabber." . $out["person"][0]['domain'] ;
            $out["person"][0]['place']   =  ($out["person"][0]['company'] === "") ? "" : $out["person"][0]['place'] ;
            $out["person"][0]['user']    =  ($out["person"][0]['company'] === "") ? "" : $out["person"][0]['user'] ;

        }

        return $out;
    }

    public function meta($request){
        $out = [];
        if(isset($request['id'])){
            $id = $request['id'];
            $out["person"] = LQL::create($this->config['db'])
                ->select('*')
                ->from('person', 'p')
                ->where('id', $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->query()
            ;
            $out["trait"] = LQL::create($this->config['db'])
                ->select("*")
                ->from('trait', 't')
                ->innerJoin("traituser tu", ' tu.trait', "t.id")
                ->innerJoin("person p", ' tu.owner', "p.id")
                ->where("p.id", $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->query()
            ;
            $out["phonebook"] = LQL::create($this->config['db'])
                ->select("*")
                ->from('phonebook', 'g')
                ->innerJoin("phoneuser pu", ' pu.phone', "g.id")
                ->innerJoin("person p", ' pu.user', "p.id")
                ->where("p.id", $id)
                ->andWhere($this->config['company']['field'], $this->config['company']['role'])
                ->query()
            ;
        }
        $out = !is_array($out) ? array() : $out;
        return  $out;
    }

    public function empty(){
        return [
            "id" => "",
            "avatar" => "",
            "firstname" => "",
            "lastname" => "",
            "alias" => "",
            "sex" => "M",
            "user" => "",
            "domain" => "",
            "company" => "",
            "place" => "",
            "position" => "",
            "category" => "",
        ];
    }
} 
