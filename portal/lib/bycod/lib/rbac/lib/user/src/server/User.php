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
	class User
	{
		public function __construct(){
			$this->db = dirname(__FILE__)."/db/user.json";
		}

		public function save($request){
			$usera = Bycod::lib("porter")->current(true);
			if(isset($request['pass'])){
				if($usera["pass"] == $request['oldpass']) unset ($request['oldpass']);
				else return false;
			}
			foreach($usera as $k=>$i) if(!isset($request[$k])) $request[$k]=$i;
			$users = json_decode($this->get(), true);	
			unset($users[$usera["user"]]);
			$users[$request["user"]] = $request;
			file_put_contents($this->db, json_encode($users));
			Bycod::lib("porter")->setSession($this->get($request));
			return $request;
		}
	
		public function get($request=false, $all=false){
			$result = file_get_contents($this->db);
			if(isset($request["user"])) {
				$users = json_decode($result, true);
				if(!isset($users[$request["user"]])) return false;
				$result = $users[$request["user"]];
				$result["user"] = $request["user"];
				if(!$all) unset($result["pass"]);
			}
			return $result;
		}
	
		public function del($request){		
			if(isset($request["user"])) {
				$users = json_decode($this->get(), true);
				if(!isset($users[$request["user"]])) return false;
				$result = $users[$request["user"]];
				$result["user"] = $request["user"];
				unset($users[$request["user"]]);
				file_put_contents($this->db, json_encode($users));
				return $result;
			}
			return false;
		}
	
		public function add($request){
			$users = json_decode($this->get(), true);
			$users[$request["user"]] = $request;
			file_put_contents($this->db, json_encode($users));
			return $request;
		}
	}
