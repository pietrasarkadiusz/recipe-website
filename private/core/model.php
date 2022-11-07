<?php

/**
 * main model
 */
class Model extends Database
{

	public function __construct()
	{

	}


	protected function get_primary_key($table)
	{

		$query = "SHOW KEYS from $table WHERE Key_name = 'PRIMARY' ";
		$db = new Database();
		$data = $db->queryNew($query);

		if(!empty($data[0]))
		{
			return $data[0]->Column_name;
		}
		return 'id';
	}

	public function getByColumn($tableName ,$columnName,$value, $class = "default", $orderby = 'desc', $limit = 10,$offset = 0)
	{

		$columnName = addslashes($columnName);
		$primary_key = $this->get_primary_key($tableName);

		$query = "select * from $tableName where $columnName = :value order by $primary_key $orderby limit $limit offset $offset";
		$data = $this->queryNew($query,$class,['value'=>$value]);

		return $data;
	}

	public function getFirstByColumn($tableName ,$columnName,$value, $class = "default", $orderby = 'desc', $limit = 10,$offset = 0)
	{

		$columnName = addslashes($columnName);
		$primary_key = $this->get_primary_key($tableName);

		$query = "select * from $tableName where $columnName = :value order by $primary_key $orderby limit $limit offset $offset";
		$data = $this->queryNew($query,$class,['value'=>$value]);

		if(is_array($data)){
			$data = $data[0];
		}
		return $data;
	}

	public function getAllFromDb($tableName, $className, $orderby = 'desc',$limit = 100,$offset = 0)
	{

		$primary_key = $this->get_primary_key($tableName);

		$query = "select * from $tableName order by $primary_key $orderby limit $limit offset $offset";
		$data = $this->queryNew($query, $className);

		return $data;

	}

	public function insert($tableName, $data)
	{

		$keys = array_keys($data);
		$columns = implode(',', $keys);
		$values = implode(',:', $keys);

		$query = "insert into $tableName ($columns) values (:$values)";

		return $this->queryWithReturnedId($query,$data);
	}

	public function insertAndReturnId($tableName, $data)
	{

		$keys = array_keys($data);
		$columns = implode(',', $keys);
		$values = implode(',:', $keys);

		$query = "insert into $tableName ($columns) values (:$values)";

		return $this->queryWithReturnedId($query,$data);
	}

	public function update($tableName, $id, $data)
	{
		$values = "";
		foreach ($data as $key => $value) {
			// code...
			$values .= $key. "=:". $key.",";
		}

		$values = trim($values,",");
 
		$data['id'] = $id;
		$query = "update $tableName set $values where id = :id";

		return $this->queryNew($query,'default',$data);
	}

	public function delete($tableName, $id)
	{
		$query = "delete from $tableName where id = :id";
		$data['id'] = $id;
		return $this->queryNew($query,'default',$data);
	}
	
}