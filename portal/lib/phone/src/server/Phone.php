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
include __DIR__ . "/model/PhoneModel.php";

class Phone
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
            "page_title_ico"=>  "fas fa-phone",
            "page_title"=> $idiom['phone']['admin']['title'],
            "page_subtitle"=> $idiom['phone']['admin']['subtitle'] . ' / '. $idiom['phone']['admin']['title'],
            "page_head"=> $this->assist->view->include(array(
                "theme/lib/dataTables/1.10.16/css/jquery.dataTables.min.css",
                "phone/src/client/css/Phone.css",
            )),
            "page_footer"=> $this->assist->view->js('Phone', 'phone'),
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
                "phone/src/client/js/Phone.js",
            )),
            "page_body"=> $this->assist->view->compile('phone:sb-admin/list')
        );
    }

    public function list($request){        
        if(isset($request['length'])) $request['limit'] = $request['length'];
        if(isset($request['start'])) $request['offset'] = $request['start'];
        $this->view = '';
        $this->model = new PhoneModel($this->assist->cfg);
        $data = $this->model->select($request);
        $data['recordsTotal'] = $data['total']; 
        $data['recordsFiltered'] = $data['recordsTotal'];
        $data['length'] = $data['limit'];
        $data['start'] = $data['offset'];
        return json_encode($data);
    }

    public function view($request){
        $this->view = ':debug/news.view';
        $items = $this->get($request);
        return array(
            "active"=>"news",
            "item"=> $items['list'][0]
        );
    }

    public function get($request=false, $normal=false){

    }

    public function save($request){
       
    }
    
    public function delete($request){

    }
} 
