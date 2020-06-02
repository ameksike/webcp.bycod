<?php

class Test{
	
	public function select($param){
		//return 
	}

	public function insert($param){
		
	}	

	public function update($param){


	}	
	
	public function delete($param){


	}	

	public function persona($param){
		$this->router()	;
	}



	public function router($param){
		switch(strtolower($_SERVER["REQUEST_METHOD"])){
			case "get": 
				return $this->select($param);
			break;

			case "post": 
				return $this->insert($param);
			break;

			case "put": 
			case "patch": 
				return $this->update($param);
			break;

			case "delete": 
			case "purge": 
				return $this->delete($param);
			break;
		}
	}
}