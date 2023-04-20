<?php

/**
 * Ingredient Model
 */
class Ingredient_model extends Model
{
    private $id;
    private $name;
    private $description;
    public $errors;

    public function __construct($name = null,$description = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(){
        return $this->id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function insertToDb()
	{
        $data['name'] = $this->name;
        $data['description'] = $this->description;

		return $this->insert('ingredients',$data);
	}

    public function updateInDb()
	{
        $data['name'] = $this->name;
        $data['description'] = $this->description;

		return $this->update('ingredients',$this->id,$data);
	}

    public function getById($id){
        return $this->getFirstByColumn('ingredients', 'id', $id, 'Ingredient');
    }

    public function getAllByRecipeId($recipe_id){
        $query = "select i.* from ingredients i inner join quantities q on q.ingredient_id=i.id where q.recipe_id = :recipe_id";
	 	$data['recipe_id'] = $recipe_id;
        return $this->queryNew($query,'Ingredient_model',$data);
    }


    public function isValid()
    {
        $this->errors = array();
        //check for ingredient name
        if(trim($this->name) == '' || !preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', $this->name))
        {
            $this->errors['ingredientName'] = "Only letters and space are allowed in ingredient name";
        }

        return count($this->errors) === 0;
    }
 
}