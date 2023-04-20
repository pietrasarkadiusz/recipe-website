<?php

/**
 * Recipe Model
 */
class Recipe_model extends Model
{
    private $id;
    private $category_id;
    private $user_id;
    private $name;
    private $description;
    private $difficulty;
    private $servings;
    private $prep_time;
    private $cook_time;
    private $image;
    public $errors;

    public function __construct($category_id=null,$user_id=null,$name=null,$description=null,$difficulty=null,$servings=null,$prep_time=null,$cook_time=null,$image=null,$id=null)
    {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->description = $description;
        $this->difficulty = $difficulty;
        $this->servings = $servings;
        $this->prep_time = $prep_time;
        $this->cook_time = $cook_time;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getAllTime()
    {
        return ($this->prep_time+$this->cook_time);
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getCookTime()
    {
        return $this->cook_time;
    }

    public function setCookTime($cook_time)
    {
        $this->cook_time = $cook_time;
        return $this;
    }

    public function getPrepTime()
    {
        return $this->prep_time;
    }

    public function setPrepTime($prep_time)
    {
        $this->prep_time = $prep_time;
        return $this;
    }

    public function getServings()
    {
        return $this->servings;
    }

    public function setServings($servings)
    {
        $this->servings = $servings;
        return $this;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function insertToDb()
	{
        $data['category_id'] = $this->category_id;
        $data['user_id'] = $this->user_id;
        $data['name'] = $this->name;
        $data['description'] = $this->description;
        $data['difficulty'] = $this->difficulty;
        $data['servings'] = $this->servings;
        $data['prep_time'] = $this->prep_time;
        $data['cook_time'] = $this->cook_time;
        $data['image'] = $this->image;

		return $this->insert('recipes',$data);
	}

    public function updateInDb()
	{
        $data['category_id'] = $this->category_id;
        $data['user_id'] = $this->user_id;
        $data['name'] = $this->name;
        $data['description'] = $this->description;
        $data['difficulty'] = $this->difficulty;
        $data['servings'] = $this->servings;
        $data['prep_time'] = $this->prep_time;
        $data['cook_time'] = $this->cook_time;
        $data['image'] = $this->image;

		return $this->update('recipes',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('recipes', $this->id);
    }

    public function findByName($name, $limit, $offset){
        $query = "select * from recipes where (name like :name) order by id desc limit $limit offset $offset";
	 	$data['name'] = $name;
        return $this->queryNew($query,'Recipe_model',$data);
    }

    public function getById($id){
        return $this->getFirstByColumn('recipes', 'id', $id, 'Recipe_model');
    }

    public function getAllByUserId($user_id){
        return $this->getByColumn('recipes', 'user_id', $user_id, 'Recipe_model');
    }

    public function getAll($limit, $offset){
        return $this->getAllFromDb('recipes','Recipe_model','desc',$limit, $offset);
    }

    public function isValid()
    {
        $this->errors = array();

        //check for recipe name
        if($this->name=='' || !preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', $this->name))
        {
            $this->errors['recipeName'] = "Only letters and space are allowed in recipe name";
        }

        //check for description
        if($this->description=='')
        {
            $this->errors['recipeDescription'] = "Recipe description is empty";
        }
 
        return count($this->errors) === 0;
    }

    public function getAllWithCategory($category_id)
    {
		$recipes = $this->getByColumn('recipes','category_id',$category_id,'Recipe_model'); 
       
        return $recipes;
    }
    
    public function getAllWithMeasurement($measurement_id)
    {
        $query = "SELECT recipes.* FROM recipes INNER JOIN quantities ON quantities.recipe_id = recipes.id WHERE quantities.measurement_id =  :measurement_id";
        $data['measurement_id'] = $measurement_id;
		$recipes = $this->queryNew($query, 'Recipe_model',$data); 
       
        return $recipes;
    }
}