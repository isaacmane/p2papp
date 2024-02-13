<?php

Class Database
{
	public function db_connect()
	{

		try{

			$string = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";";

			$db = new PDO($string,DB_USER,DB_PASS);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;

		}catch(PDOexception $e){

			die($e->getMessage());
		}
	}

	public function read($query, $data = [])
	{		
		$DB = $this->db_connect();
		//echo $query."<br>";
		$stm = $DB->prepare($query);
		if(count($data) == 0)
		{			
			//echo $query."<br>";
			$stm = $DB->query($query);			
			$check = 0;
			if($stm){
				$check = 1;
			}
		}else{
			//show($data);
			$check = $stm->execute($data);
		}

		if($check)
		{
			$data = $stm->fetchAll(PDO::FETCH_OBJ);
			/*echo "<pre>";
			print_r($data);
			echo "<pre>";*/

			if(is_array($data) && count($data) > 0)
			{
				return $data;
			}
			
			return false;
		}else
		{
			return false;
		} 
	} 

	//public function write($query, $data = [])
	public function write($query, $data)
	{
		$DB = $this->db_connect();
		$stm = $DB->prepare($query);	
		if(count($data) == 0)
		{
			$stm = $DB->query($query);
			$check = 0;
			if($stm){
				$check = 1;
			}
		}else{
			
			try {
				//print_r($data);
				//echo $query;
				$check = $stm->execute($data);
			}
			//catch exception
			catch(Exception $e) {
			  echo 'Message: ' .$e->getMessage();
			}
					
		}

		if($check)
		{
			return true;
		}else{
			return false;
		} 
	}
}