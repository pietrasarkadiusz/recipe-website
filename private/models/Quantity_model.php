<?php

/**
 * Quantity Model
 */
class Quantity_model extends Model
{
    private $id;
    private $recipe_id;
    private $ingredient_id;
    private $measurement_id;
    private $quantity;
    //private Ingredient_model $ingredient;
    public $errors;

    public function __construct($quantity = null, $measurement_id = null, $recipe_id = null, $ingredient_id = null, $id = null)
    {
        $this->id = $id;
        $this->recipe_id = $recipe_id;
        $this->ingredient_id = $ingredient_id;
        $this->measurement_id = $measurement_id;
        $this->quantity = $quantity;
    }

    /*public function setIngredient(Ingredient_model $ingredient)
    {
        $this->$ingredient = $ingredient;
    }

    public function getIngredient()
    {
        return $this->$ingredient;
    }*/

    public function getId(){
        return $this->id;
    }

    public function getRecipeId()
    {
        return $this->recipe_id;
    }

    public function setRecipeId($recipe_id)
    {
        $this->recipe_id = $recipe_id;
        return $this;
    }

    public function getIngredientId()
    {
        return $this->ingredient_id;
    }

    public function setIngredientId($ingredient_id)
    {
        $this->ingredient_id = $ingredient_id;
        return $this;
    }
    public function getMeasurementId()
    {
        return $this->measurement_id;
    }

    public function setMeasurementId($measurement_id)
    {
        $this->measurement_id = $measurement_id;
        return $this;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function insertToDb()
	{
        $data['ingredient_id'] = $this->ingredient_id;
        $data['measurement_id'] = $this->measurement_id;
        $data['quantity'] = $this->quantity;
        $data['recipe_id'] = $this->recipe_id;

		return $this->insert('quantities',$data);
	}

    public function updateInDb()
	{
        $data['ingredient_id'] = $this->ingredient_id;
        $data['measurement_id'] = $this->measurement_id;
        $data['quantity'] = $this->quantity;
        $data['recipe_id'] = $this->recipe_id;

		return $this->update('quantities',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('quantities', $this->id);
    }

    public function getAllByRecipeId($recipe_id){
        return $this->getByColumn('quantities', 'recipe_id', $recipe_id, 'Quantity_model');
    }

    public function isValid()
    {
        $this->errors = array();

        //check for name
        if($this->quantity=='' || !preg_match('/^[0-9\.,]+$/', $this->quantity))
        {
            $this->errors['quantity'] = "Only numbers in ingredient quantity";
        }

        return count($this->errors) === 0;
    }

    public function deleteAllQuantitiesWithIngredients($recipe_id){
        $query = "DELETE ingredients, quantities FROM quantities INNER JOIN ingredients ON quantities.ingredient_id = ingredients.id WHERE quantities.recipe_id = :recipe_id";
        $data['recipe_id'] = $recipe_id;
		$this->queryNew($query, 'default',$data); 
    }
}