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
include __DIR__ . "/model/PersonModel.php";

class Person
{
    public function __construct(){
        $this->view = ':';
    }

    public function index(){
        $this->view = 'theme:debug/portfolio';
        return array("active"=>"portfolio");
    }

    public function show(){
        $idiom = $this->assist->view->idiom("theme");
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title_ico"=>  "fas fa-user",
            "page_title"=> $idiom['person']['admin']['title'],
            "page_subtitle"=> $idiom['person']['admin']['subtitle'] . ' / ' .  $idiom['person']['admin']['title'],
            "page_head"=> $this->assist->view->include(array(
                "theme/lib/dataTables/1.10.16/css/jquery.dataTables.min.css",
                "person/src/client/css/Person.css",
            )),
            "page_footer"=> $this->assist->view->include(array(
                "theme/idiom/es.js",
                "theme/src/client/js/utils.js",
                "theme/lib/jquery/1.9.1/jquery.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.core.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.widget.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.mouse.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.draggable.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.position.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.resizable.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.button.js",
                "theme/lib/jquery/1.10.3/ui/jquery.ui.dialog.js",
                "theme/lib/dataTables/1.10.16/js/jquery.dataTables.min.js" ,
                "theme/lib/dataTables/1.10.20/js/dataTables.bootstrap4.min.js",
                "person/src/client/js/Person.js",
            )),
            "page_body"=> $this->assist->view->compile('person:sb-admin/list')
        );
    }

    public function edit($request){
        $request['id'] = isset($request['id']) ? $request['id'] : ((isset($request['params'][0])) ? $request['params'][0]: '') ;
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';

        if(isset($request['btnSave'])){
            print_r($request);
        }

        $this->model = new PersonModel($this->assist->cfg);
        $data = $this->model->get($request);
        $data = isset($data['person'][0]) ? $data['person'][0] : $this->model->empty();
        $data = $this->formatPerson($data);

        return array(
            "active"=>"portfolio",
            "page_title_ico"=>  "fas fa-newspaper",
            "page_head" => $this->assist->view->include(array(
                "news/src/client/css/Edit.css",
            )),
            "page_footer"=> $this->assist->view->include(array(
                "theme/idiom/es.js",
                "theme/src/client/js/utils.js",
                "theme/lib/img/imgloader.js",
                "theme/lib/tinymce/jquery.tinymce.min.js",
                "theme/lib/tinymce/tinymce.min.js",
                "news/src/client/js/Edit.js",
                "news/src/client/js/Edit.js",
            )),
            "page_title"=>  $idiom['person']['admin']['title'],
            "page_subtitle"=> $idiom['person']['admin']['subtitle'] . ' / ' .  $idiom['person']['admin']['title']. ' / ' .  $idiom['person']['admin']['title'],
            "page_body"=> $this->assist->view->compile('person:sb-admin/form', ['model'=> $data] )
        );
    }

    public function view($request){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';

        $this->model = new PersonModel($this->assist->cfg);
        $data = $this->model->get($request);
        $data = isset($data['person'][0]) ? $data['person'][0] : $this->model->empty();
        $data = $this->formatPerson($data);

        return array(
            "active"=>"portfolio",
            "page_title_ico"=>  "fas fa-newspaper",
            "page_head" => $this->assist->view->include(array(
                "news/src/client/css/Edit.css",
            )),
            "page_footer"=> $this->assist->view->include(array(
                "theme/idiom/es.js",
                "theme/src/client/js/utils.js",
                "theme/lib/img/imgloader.js",
                "theme/lib/tinymce/jquery.tinymce.min.js",
                "theme/lib/tinymce/tinymce.min.js",
                "news/src/client/js/Edit.js",
                "news/src/client/js/Edit.js",
            )),
            "page_title"=>  $idiom['person']['admin']['title'],
            "page_subtitle"=> $idiom['person']['admin']['subtitle'] . ' / ' .  $idiom['person']['admin']['title']. ' / ' .  $idiom['person']['admin']['title'],
            "page_body"=> $this->assist->view->compile('person:sb-admin/form', ['model'=> $data] )
        );
    }

    public function list($request){
        if($request['length']) $request['limit'] = $request['length'];
        if($request['start']) $request['offset'] = $request['start'];
        $this->view = '';
        $this->model = new PersonModel($this->assist->cfg);
        $out = $this->model->list($request);
        $out = $this->formatList($out);
        return json_encode($out);
    }

    public function meta($request){
        $this->view = 'person:sb-admin/meta';
        return $this->metadata($request);
    }

    public function metadata($request){
        $request['id'] = isset($request['id']) ? $request['id'] : ((isset($request['params'][0])) ? $request['params'][0]: '') ;
        $this->model = new PersonModel($this->assist->cfg);
        $out = $this->model->meta($request);
        $out["person"] = $this->formatPerson($out["person"][0]) ;
        return $out;
    }

    private function formatList($data){
        $out = $data['data'];
        $url = $this->assist->router->url(".");  
        $path =  $this->assist->router->path();
        foreach ($out as $k=>$i){          
            $out[$k] = $this->formatPerson($i) ;
        }
        $data['data'] = $out;
        $data['recordsTotal'] = $data['total']; 
        $data['recordsFiltered'] = $data['recordsTotal'];
        $data['length'] = $data['limit'];
        $data['start'] = $data['offset'];
        return $data;
    }

    private function formatPerson($person){
        $url = $this->assist->router->url(".");   
        $path =  $this->assist->router->path();

        $this->assist->log($url);
        $this->assist->log($path);

        $person['avatar'] =  "data/user/".strtolower($person['company'])."/". strtolower($person['user']) . ".jpg";
        if(!file_exists($path .  '/' . $person['avatar'])){
            $person['avatar'] = $url. "data/user/user_".$person['sex'].".svg";
        }
        else{
            $person['avatar'] = $url.$person['avatar'];
        }

        //$person['sex'] = ($person['sex'] == "F") ? "Femenino" : "Masculino";
        $person['company'] =  $person['company'] == 'Other' ? "" : $person['company'];
        $person['domain']  =  ($person['company'] === "") ? "" : $person['domain'] ;
        $person['email']   =  ($person['company'] === "") ? "" : $person['user'] . "@" . $person['domain'] ;
        $person['chat']   =    ($person['company'] === "") ? "" : $person['user'] . "@" . $person['domain'] ;
        $person['place']   =  ($person['company'] === "") ? "" : $person['place'] ;
        $person['user']    =  ($person['company'] === "") ? "" : $person['user'] ;

        return $person;
    } 
} 
