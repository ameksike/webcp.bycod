<?php
/*
 * @framework: Bycod
 * @package: Event
 * @version: 0.1
 * @author: Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/5/2011
 * @update: 23/4/2011
 * @description: This is simple and light loader event manager
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 * */
class EventRequest{
    public function get($signal, $value, $index=0){
        switch(gettype($value)){
            case 'array': return array($value['target'], $value['signal']); break;
            default: return array($value, $signal); break;
        }
    }
}
class EventResponse{
    public function get($target, $params=array()){
        return method_exists($target[0], $target[1]) ? call_user_func_array($target, is_array($params) ? $params : array($params)) : false;
    }
}
class Event{
    static  $obj = 0;
    public static function this($links=array()){
        self::$obj = (!self::$obj) ? new self($links) : self::$obj;
        return self::$obj;
    }

    protected $links;
    protected $request;
    protected $response;
    protected $flag;

    public function __construct($links=null, $request=null, $response=null){
        $this->flag = true;
        $this->links = array('defaults'=>array());
        $this->request =  new EventRequest();
        $this->response = new EventResponse();
        $this->setting($links, $request, $response);
    }
    public function setting($links=null, $request=null, $response=null){
        $this->links = is_array($links) ? array_merge ($this->links, $links) : $this->links;
        $this->request = $request ? $request : $this->request;
        $this->response = $response ? $response : $this->response;
    }
    public function supply($target, $signal='defaults'){
        $this->links[$signal][] = $target;
    }
    public function delete($pos, $signal='defaults'){
        unset($this->links[$signal][$pos]);
    }
    public function emit($signal='', $params=array()){
        if(!isset($this->links[$signal])) return false;
        $params = !is_array($params) ? array($params) : $params;
        $response = array();
        foreach($this->links[$signal] as $k=>$i){
            if(!$this->flag) break;
            $target = $this->request->get($signal, $i, $k);
            $response[] = $this->response->get($target, $params);
        }
        return $response;
    }
    public function stop(){
        $this->flag = false;
    }
}