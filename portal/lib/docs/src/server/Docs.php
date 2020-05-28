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

class Docs
{
    public function __construct(){
        $this->view = ':';
    }

    public function index(){
        $this->view = 'theme:debug/news';
        $items = $this->get();
        return array(
            "active"=>"news",
            'limit'=> $items['limit'],
            'offset'=> $items['offset'],
            'total'=> $items['total'],
            "data"=> $items['list']
        );
    }

    public function show(){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title_ico"=>  "fas fa-book",
            "page_title"=> $idiom['docs']['admin']['title'],
            "page_subtitle"=> $idiom['docs']['admin']['subtitle'] . ' / ' . $idiom['docs']['admin']['title'],
            "page_head"=> $this->assist->view->css('Docs', 'docs'),
            "page_footer"=> $this->assist->view->js('Docs', 'docs'),
            "page_body"=> $this->assist->view->compile('docs:sb-admin/list')
        );
    }

    public function view($request){
        $this->view = ':debug/news.view';
        $items = $this->get($request);
        return array(
            "active"=>"news",
            "item"=> $items['list'][0]
        );
    }
    
    public function last(){
        $config = $this->assist->cfg;
        $lst = LQL::create($config['db'])->select('*')->from('article', 'a')->orderBy('a.date', 'DESC')->limit(3)->execute();
        return $lst;
    }

    public function get($request=false, $normal=false){
        $id = !$request ? '' :  isset($request['id']) ? $request['id'] : $request['param'] ;
        $limit = !$request ? '' :  isset($request['limit']) ? $request['limit'] : 9;
        $offset = !$request ? '' :  isset($request['offset']) ? $request['offset'] : 0;

        $config = $this->assist->cfg;
        $qm = LQL::create($config['db'])
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
        $total = LQL::create($config['db'])->select('count(id) as total')->from('article', 'a')->execute();

        return array('total'=>$total[0]['total'], 'list'=>$out, 'limit'=>9, 'offset'=>1);
    }

    public function relevant(){
        $config = $this->assist->cfg;
        $rel = LQL::create($config['db'])->select('*')->from('article', 'a')->where('a.status', 'relevant')->orderBy('a.date', 'DESC')->limit(2)->execute();
        return $rel;
    }

    public function save($request){
        $id = isset($request['id']) ? $request['id'] : $request['param'] ;
        $config = $this->assist->cfg;
        $obj = $request;

        unset($obj['btnSafe'], $obj['art'], $obj['type']);
        //$obj['description'] = validate($obj, 'description');
        //$obj['sumary'] = validate($obj, 'sumary');
        
        //file_put_contents(__DIR__."/../../save.log", print_r($obj, true));
    
        if($obj['id']!='') {
            $qm = LQL::create($config['db'])
                ->update('article')
                ->set( array_keys($obj), array_values($obj))
                    //['title', 'sumary', 'description', 'date', 'author', 'imgico',  'imgfront',  'url', 'status'], 
                    //[$obj['title'],$obj['sumary'],$obj['description'],$obj['date'],$obj['imgico'],$obj['imgfront'],$obj['url'],$obj['status'],$obj['status'],]
                ->where('id', $obj['id'])
                ->execute();
            ;
        }else{
            $sql = LQL::create($config['db'])
                ->insert('article')
                ->into('title', 'sumary', 'description', 'date', 'author', 'imgico',  'imgfront',  'url', 'status')
                ->values($obj['title'],$obj['sumary'],$obj['description'],$obj['date'],$obj['author'],$obj['imgico'],$obj['imgfront'],$obj['url'],$obj['status'])
                ->execute()
            ;
        }
    }
    
    public function delete($request){
        $id = isset($request['id']) ? $request['id'] : $request['param'] ;
        $config = $this->assist->cfg;

        if(!empty($id)) {
            $qm = LQL::create($config['db'])
                ->delete('article')
                ->where('id', $id)
                ->execute();
            ;
        }
    }

    public function upload(){
        $path = "resource/article/0/" ;
        $exte = array("gif", "jpg", "png");

        reset($_FILES);
        $temp = current($_FILES);
        $fileName = "";

        if(is_uploaded_file($temp['tmp_name']))
        {
            /*if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
                header("HTTP/1.1 400 Invalid file name,Bad request");
                return;
            }
            if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), $exte)){
                header("HTTP/1.1 400 Invalid extension,Bad request");
                return;
            }*/
            
            $fileName = $path . $temp['name'];
            $route = $this->assist->route("news") ;
            move_uploaded_file($temp['tmp_name'],  $route . $fileName);
        }
    }
} 
