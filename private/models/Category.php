<?php

/**
 * Category Model
 */

class Category extends Model
{
    private $id;
    private $name;
    public $errors = array();
    
    public function __construct($name = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function isValid()
    {
        $this->errors = array();

        if($this->name === "")
        {
            $this->errors['categoryName'] = "The name of the category is required";
        }

        return count($this->errors) === 0;
    }

    public function insertToDb()
	{
        $data['name'] = $this->name;
		return $this->insert('categories',$data);
	}

    public function updateInDb()
	{
        $data['name'] = $this->name;
		return $this->update('categories',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('categories', $this->id);
    }

    public function findByName($name){
        $query = "select * from categories where (name like :name) order by id desc";
	 	$data['name'] = $name;
        return $this->queryNew($query,'Category',$data);
    }

    public function getById($id){
        return $this->getFirstByColumn('categories', 'id', $id, 'Category');
    }

    public function getAll(){
        return $this->getAllFromDb('categories','Category');
    }
}