<?php
/**
 *
 * @framework: Bycod
 * @package: request
 * @version: 0.1
 * @description: InDriver es una libreria para el trabajo con los formatos de entrada del servidor
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v2
 *
 */
class InDriverLIST extends InDriver
{
    public function process($request, $router){     
        $type = $this->tool->formatType($request['type']);
        $keys = $router['pattern']["default"];
        $delimiter = isset($router['delimiter'][$type]) ? $router['delimiter'][$type] : "/" ;

        switch($type){
            case "web":   
            case "pretty": 
                $request['option'] = $this->tool->fillOptions(
                    $request['option'], 
                    $this->tool->argPretty($delimiter), 
                    $keys
                ); 
                $request['option'] = array_merge($this->tool->argHtml($delimiter), $request['option']);
            break; 
            case "cli":    $request['option'] = $this->tool->fillOptions($request['option'], $this->tool->argCli($delimiter), $keys); break; 
            case "scheme": $request['option'] = $this->tool->fillOptions($request['option'], $this->tool->argScheme($delimiter, $request['option']['scheme']), $keys); break; 
        }
        return $request; 
    }
}