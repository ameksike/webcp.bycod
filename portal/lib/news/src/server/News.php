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

include __DIR__ . "/model/NewsModel.php";

class News
{
    public $model;

    public function __construct(){
        $this->view = ':';
    }

    public function index(){
        $this->view = 'theme:debug/news';
        $this->model = new NewsModel($this->assist->cfg);
        $items = $this->model->get();
        return array(
            "active"=>"news",
            'limit'=> $items['limit'],
            'offset'=> $items['offset'],
            'total'=> $items['total'],
            "data"=> $items['data']
        );
    }

    public function delete($request){
        $this->model = new NewsModel($this->assist->cfg);
        $this->model->delete($request);
        return $this->backend();
    }

    public function fixUrl($data){

        $data["imgico"] = str_ireplace("resource/article/", $this->assist->router->urlModule("news") . "resource/article/", $data["imgico"]);
        $data["imgfront"] = str_ireplace("resource/article/", $this->assist->router->urlModule("news")  . "resource/article/", $data["imgfront"]);
        $data["sumary"] = str_ireplace("resource/article/", $this->assist->router->urlModule("news")  . "resource/article/", $data["sumary"]);
        $data["description"] = str_ireplace("resource/article/", $this->assist->router->urlModule("news") . "resource/article/" , $data["description"]);
        return $data;
    }

    public function edit($request){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';

        $this->model = new NewsModel($this->assist->cfg);
        $data = $this->model->get($request);
        $data = isset($data['data'][0]) ? $data['data'][0] : $this->model->empty();
        $data = $this->fixUrl($data);

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
            "page_title"=>  $idiom['news']['admin']['title'],
            "page_subtitle"=> $idiom['news']['admin']['subtitle'] . ' / ' .  $idiom['news']['admin']['title'],
            "page_body"=> $this->assist->view->compile('news:sb-admin/form', ['model'=>$data] )
        );
    }

    public function get($request=false, $normal=false){
        if(isset($request['length'])) $request['limit'] = $request['length'];
        if(isset($request['start'])) $request['offset'] = $request['start'];
        $this->view = '';
        $this->model = new NewsModel($this->assist->cfg);
        $data = $this->model->get($request, $normal);
        $data['recordsTotal'] = $data['total']; 
        $data['recordsFiltered'] = $data['recordsTotal'];
        $data['length'] = $data['limit'];
        $data['start'] = $data['offset'];
        return json_encode($data);
    }

    public function backend(){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title_ico"=>  "fas fa-newspaper",
            "page_head"=> $this->assist->view->include(array(
                "theme/lib/dataTables/1.10.16/css/jquery.dataTables.min.css",
                "news/src/client/css/News.css",
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
                "news/src/client/js/News.js",
            )),
            "page_title"=>  $idiom['news']['admin']['title'],
            "page_subtitle"=> $idiom['news']['admin']['subtitle'] . ' / ' .  $idiom['news']['admin']['title'],
            "page_body"=> $this->assist->view->compile('news:sb-admin/list')
        );
    }

    public function view($request){
        $this->view = 'theme:debug/news.view';        
        $this->model = new NewsModel($this->assist->cfg);
        $items = $this->model->get($request);

        return array(
            "active"=>"news",
            "item"=> isset($items['data'][0]) ? $items['data'][0] : $this->model->empty()
        );
    }
    
    public function upload(){
        $path = "/resource/article/0/" ;

        try{
            reset($_FILES);
            $temp = current($_FILES);
            $fileName = "";
    
            if(is_uploaded_file($temp['tmp_name']))
            {
                $fileName = $path . $temp['name'];
                $route = $this->assist->route("news") ;
                move_uploaded_file($temp['tmp_name'],  $route . $fileName);
            }
        }
        catch (\Exception $e){
            return false;
        }
        return $this->assist->view->url("lib/news". $fileName) ;
    }
} 
