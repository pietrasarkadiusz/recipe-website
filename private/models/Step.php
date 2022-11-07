<?php

/**
 * Step Model
 */
class Step extends Model
{
    private $id;
    private $recipe_id;
    private $number;
    private $description;
    public $errors;

    public function __construct($description = null, $number = null, $recipe_id = null, $id = null)
    {
        $this->id = $id;
        $this->number = $number;
        $this->description = $description;
        $this->recipe_id = $recipe_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getNumber(){
        return $this->number;
    }

    public function setNumber($number){
        $this->number = $number;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setRecipeId($recipe_id){
        $this->recipe_id = $recipe_id;
        return $this;
    }

    public function insertToDb()
	{
        $data['recipe_id'] = $this->recipe_id;
        $data['number'] = $this->number;
        $data['description'] = $this->description;

		return $this->insert('steps',$data);
	}

    public function updateInDb()
	{
        $data['recipe_id'] = $this->recipe_id;
        $data['number'] = $this->number;
        $data['description'] = $this->description;

		return $this->update('steps',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('steps', $this->id);
    }

    public function isValid()
    {
        $this->errors = array();

        //check for name
        if($this->description == '')
        {
            $this->errors['stepDescription'] = "Step description is empty";
        }

        return count($this->errors) === 0;
    }

    public function getAllByRecipeId($recipe_id){
        return $this->getByColumn('steps', 'recipe_id', $recipe_id, 'Step', 'asc');
    }

    public function deleteAllWithRecipeId($recipe_id)
    {
        $query = "delete from steps where recipe_id = :recipe_id";
		$data['recipe_id'] = $recipe_id;
		return $this->queryNew($query,'default',$data);
    }
 
}