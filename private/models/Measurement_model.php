<?php

/**
 * Measurement Model
 */
class Measurement_model extends Model
{
    public $id;
    public $name;
    public $errors = array();
    
    public function __construct($name = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getErrors()
    {
        return $this->errors;
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
            $this->errors['measurementName'] = "The name of the measurement is required";
        }

        return count($this->errors) === 0;
    }

    public function insertToDb()
	{
        $data['name'] = $this->name;
		return $this->insert('measurements',$data);
	}

    public function updateInDb()
	{
        $data['name'] = $this->name;
		return $this->update('measurements',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('measurements', $this->id);
    }

    public function serialize(){
        return json_encode(get_object_vars ($this));
    }

    public function getAllByRecipeId($recipe_id){
        $query = "select m.* from measurements m inner join quantities q on q.measurement_id=m.id where q.recipe_id = :recipe_id";
	 	$data['recipe_id'] = $recipe_id;
        return $this->queryNew($query,'Measurement_model',$data);
    }

    public function findByName($name){
        $query = "select * from measurements where (name like :name) order by id desc";
	 	$data['name'] = $name;
        return $this->queryNew($query,'Measurement_model',$data);
    }

    public function getById($id){
        return $this->getFirstByColumn('measurements', 'id', $id, 'Measurement_model');
    }

    public function getAll(){
        return $this->getAllFromDb('measurements','Measurement_model');
    }
}