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
	class Porter
	{
		public function load(){
			return $this->current();
		}

		public function dologin($request){
			$users = json_decode($this->assist->user->get(), true);
			if(!isset($request["user"])) return "failed";
			if(!isset($users[$request["user"]])) return "failed";
			if(!isset($request["pass"])){
				$pass = $users[$request["user"]]["pass"];
				$users[$request["user"]]["pass"] = md5($users[$request["user"]]["pass"]);
				file_put_contents($this->db, json_encode($users));
                $msg = false;
                /*$this->assist->mailer->setting($this->config['mail']);
				$msg = $this->assist->mailer->sendMSG(array(
					"to"=> $users[$request["user"]]["email"],
					"subject"=>"Solicitud de Nuevo Password",
					"tpl" => dirname(__FILE__)."/tpl/remember.tpl",
					"body" => array("pass" => $pass, "user"=>$request["user"])
				));*/
				return $msg ? "remember" : "noremember";
			}else{
				if($this->verify($users[$request["user"]], $request)) return "success";
				else return "failed";
			}
		}

		public function authorize($module, $action){
			$user = $this->getSession();
			$access = $this->assist->role->access();

			if(!isset($access[$user['role']])) return false;
			$licence = $access[$user['role']];

			if(!is_array($licence)) return $licence;
			if(isset($licence[$module])){
				if(is_array($licence[$module])){
					if(isset($licence[$module][$action])) return $licence[$module][$action];
				}else return $licence[$module];
			}
			return false;
		}
		public function verify($user, $request){
			$pass  = $user["pass"];
			$user["user"] = $request["user"];
			$user  = ($pass == $request["pass"]) ? $user : false;
			if($user){
				$this->setSession($user);
				return true;
			}return false;				
		}
		
		public function denied($module, $action){
			$this->assist->cfg["bycod"]["request"]["controller"] = "main";
            $this->assist->cfg["bycod"]["request"]["action"] = "index";
		}

		public function getSession(){
			if(!isset($_SESSION['user']))
				$_SESSION['user'] = array( "name"=>"Invitado", "role"=>"guest" );
			return $_SESSION['user'];
		} 

		public function setSession($user){
			$_SESSION['user'] = $user;
		} 

		public function delSession(){
			unset($_SESSION['user']); 
		} 

		public function current($all=false){
			$user = $this->getSession();
			return ($user['role']!='guest') ? $this->assist->user->get($user, $all) : $user ;
		}

        public function onAccess($assist){
            if($assist->request->method() != "cli"){
                session_start();
                if(!$this->authorize($assist->tmp['map']['user'], $assist->tmp['map']['pass']))
                    $assist->tmp['map']['response'] = $this->denied($assist->tmp['map']['user'], $assist->tmp['map']['pass']);
            }
        }
	}
