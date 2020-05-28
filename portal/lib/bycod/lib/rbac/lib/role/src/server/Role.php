<?php
/*
 * @framework: Bycod
 * @package: View
 * @version: 0.1
 * @description: This is simple and light RBAC layer
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*, porter, role, user, officer
 */
	class Role
	{
		public function __construct(){
            $this->db = false;
			$this->data = false;
		}

		public function load($acl="default", $force=false){
            if($force || !$this->db) $this->db = dirname(__FILE__)."/db/$acl.acl";
			if(!$this->data) $this->data = json_decode(file_get_contents($this->db), true);
			return $this->data;
		}
		
		public function save($request){
			if(isset($request['pass'])){
				
			}
			return $request;
		}
	
		public function acl($user=false){
			$result = $this->load();
			/*if(isset($result[$user])) {
				$result = $result[$request["user"]];
			}*/
			return $result;
		}
	
		public function del($request){		
			if(isset($request["user"])) {
				
			}
			return false;
		}
	
		public function add($request){
			return $request;
		}
	}
