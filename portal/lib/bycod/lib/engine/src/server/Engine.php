<?php
/*
 * @framework: Bycod
 * @package: Notary
 * @version: 0.1
 * @description: This is simple and Light Framework Engine
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*, Event
 */
class EngineEventRequest{
    public function get($signal, $value, $index=0){
        switch(gettype($value)){
            case 'string': return Bycod::lib($value) ? array(Bycod::lib($value), $signal) :  array($value, $signal); break;
            case 'array': return array($value['target'], $value['signal']); break;
            default: return array($value, $signal); break;
        }
    }
}
class Engine
{
    public function __construct(){}
    public function setting($option=0){
        $option = is_array($option) ? $option : array();
        $this->assist->event->setting(null, new EngineEventRequest);
        $this->assist->setting($option);
        $this->assist->setting($this->assist->config());
        $this->assist->event->setting($this->assist->cfg['bycod']['engine']['links']);
        $this->assist->event->emit('onConfig', $this->assist);
        $this->assist->event->setting($this->assist->cfg['bycod']['engine']['links']);
        return $this;
    }
    
    public function dispatch($params=false){
        return $this->process($params);
    }

    public function process($params=false){
        $this->formatRequest($params);
        $this->start();
        return $this->assist->cfg['bycod']["response"]['data'];
    }

    public function formatRequest($request){
        if(is_array($request)){
            $this->assist->cfg['bycod']['request'] = $request;
            $this->assist->cfg['bycod']['request']['type'] = "none"; 
        }
        if(is_string($request)){
            $this->assist->cfg['bycod']['request']['option']['scheme'] = $request;
            $this->assist->cfg['bycod']['request']['type'] = "scheme"; 
        }
    }

    public function start(){
        $this->assist->cfg['bycod']["response"]['data'] = "";
        foreach($this->assist->cfg['bycod']['engine']['workflow'] as $event)
            $this->assist->event->emit($event, $this->assist);
    }
    public function stop(){
        $this->assist->event->emit('onStop',  $this->assist);
        $this->assist->event->stop();
    }
}