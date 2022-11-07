<?php

/**
 * Database connection
 */
class Database
{
	
	private function connect()
	{
		$string = DBDRIVER . ":host=".DBHOST.";dbname=".DBNAME;
		if(!$con = new PDO($string,DBUSER,DBPASS)){
			die("Could not connect to database");
		}

		return $con;
	}

	public function queryNew($query, $class = "default", $data = array())
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		if($stm){
			$check = $stm->execute($data);
			if($check){
				if($class === "default"){
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
				}else{
					$data = $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,$class);
				}

				if(is_array($data) && count($data) >0){
					return $data;
				}

 			}
		}

		return false;
	}

	public function queryWithReturnedId($query,$data = array())
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		if($stm){
			$check = $stm->execute($data);
			$lastId = $con->lastInsertId();
			if($check){
				return $lastId;
 			}
		}

		return false;
	}
}