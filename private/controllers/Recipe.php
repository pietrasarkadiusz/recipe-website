<?php

/**
 * recipe controller
 */
class Recipe extends Controller
{
	
	function index($id = '')
	{

		$steps = new Step();
		$steps = $steps->getAllByRecipeId($id);
		
		$quantities = new Quantity_model();
		$quantities = $quantities->getAllByRecipeId($id);

		$measurements = new Measurement_model();
		$measurements = $measurements->getAllByRecipeId($id);

		$ingredients = new Ingredient_model();
		$ingredients = $ingredients->getAllByRecipeId($id);

		$recipe = new Recipe_model();
		$recipe = $recipe->getById($id);

		$user = new User();
		$user = $user->getById($recipe->getUserId());

		$this->view('recipe',[
			'recipe'=>$recipe,
			'steps'=>$steps,
			'quantities'=>$quantities,
			'ingredients'=>$ingredients,
			'measurements'=>$measurements,
			'user'=>$user
		]);
		
	}

	public function add()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();
		if(count($_POST) > 0)
 		{

			$recipe = new Recipe_model($_POST['category_id'],Auth::getId(),$_POST['name'],$_POST['description'],$_POST['difficulty'],$_POST['servings'],$_POST['prep_time'],$_POST['cook_time'],$_POST['image']);
			
			$ingredients = array();
			$quantities = array();
			foreach ($_POST['quantities'] as $key => $quantity) {
				$quantities[] = new Quantity_model($quantity['quantity']);
				$ingredients[] = new Ingredient_model($_POST['ingredientsName'][$key]['name'],$_POST['ingredientsDescription'][$key]['description']);
			}

			$steps = array();
			foreach ($_POST['steps'] as $step) {
				$steps[] = new Step($step['description']);
			}

			if($this->validateAll($recipe, $quantities, $ingredients, $steps))
 			{
				
 				$recipeId = $recipe->insertToDb();

				foreach($steps as $key => $step) {
					$step->setRecipeId($recipeId)->setNumber($key+1);
					$step->insertToDb();
				}

				foreach($ingredients as $key => $ingredient) {
					$ingredientId = $ingredient->insertToDb();
					$quantities[$key]->setRecipeId($recipeId)->setIngredientId($ingredientId)
									->setMeasurementId($_POST['measurements'][$key]['measurement_id']);
					$quantities[$key]->insertToDb();
				}


				$this->redirect('recipe/'.$recipeId);
 			}else
 			{
 				//errors
 				$errors += $recipe->errors;
				foreach ($ingredients as $ingredient) {
					$errors += $ingredient->errors;
				}
				foreach ($quantities as $quantity) {
					$errors += $quantity->errors;
				}
				foreach ($steps as $step) {
					$errors += $step->errors;
				}
 			}
 		}
			
		$category = new Category();
		$data['allCategories'] = $category->getAll();
		$measurement = new Measurement_model();
		$data['allMeasurements'] = $measurement->getAll();
		
		$data['errors'] = $errors;

		$this->view('recipe.add',$data);
	}

	function edit($id = '')
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();

		$id = trim($id == '') ? Auth::getId() : $id;

		$steps = new Step();
		$steps = $steps->getAllByRecipeId($id);
		
		$quantities = new Quantity_model();
		$quantities = $quantities->getAllByRecipeId($id);

		$measurements = new Measurement_model();
		$measurements = $measurements->getAllByRecipeId($id);

		$ingredients = new Ingredient_model();
		$ingredients = $ingredients->getAllByRecipeId($id);

		$recipe = new Recipe_model();
		$recipe = $recipe->getById($id);

		if(count($_POST) > 0 && Auth::i_own_content($recipe->getUserId()))
 		{

			$recipe->setName($_POST['name'])->setCategoryId($_POST['category_id'])->setDescription($_POST['description'])
					->setDifficulty($_POST['difficulty'])->setServings($_POST['servings'])->setPrepTime($_POST['prep_time'])
					->setCookTime($_POST['cook_time']);
			
			foreach ($ingredients as $key => $ingredient) {
				$ingredient->setName($_POST['ingredients'][$key]['name'])->setDescription($_POST['ingredients'][$key]['description']);
			}

			foreach ($quantities as $key => $quantity) {
				$quantity->setQuantity($_POST['quantities'][$key]['quantity'])->setMeasurementid($_POST['quantities'][$key]['measurement_id']);
			}

			foreach ($steps as $key => $step) {
				$step->setDescription($_POST['steps'][$key]['description']);
			}

			if($this->validateAll($recipe, $quantities, $ingredients, $steps)) 
 			{

				if($myimage = upload_image($_FILES))
 				{
 					$recipe->setImage($myimage);
 				}
				
 				$recipe->updateInDb();

				foreach($steps as $key => $val ) {
					$val->updateInDb();
				}

				foreach($ingredients as $val ) {
					$val->updateInDb();
				}

				foreach($quantities as $val ) {
					$val->updateInDb();
				}

 				$this->redirect('recipe/edit/'.$id);
 			}else
 			{
 				//errors
				 $errors += $recipe->errors;
				 foreach ($ingredients as $ingredient) {
					 $errors += $ingredient->errors;
				 }
				 foreach ($quantities as $quantity) {
					 $errors += $quantity->errors;
				 }
				 foreach ($steps as $step) {
					 $errors += $step->errors;
				 }
 			}
 		}
		
		 $allCategories = new Category();
		 $allCategories = $allCategories->getAll();
		 $allMeasurements = new Measurement_model();
		 $allMeasurements = $allMeasurements->getAll();

		$this->view('recipe.edit',[
			'recipe'=>$recipe,
			'steps'=>$steps,
			'quantities'=>$quantities,
			'ingredients'=>$ingredients,
			'measurements'=>$measurements,
			'allMeasurements'=>$allMeasurements,
			'allCategories'=>$allCategories,
			'errors'=>$errors
	]);

	}

	public function delete($id = null)
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

 
		$recipe = new Recipe_model();
 		$recipe = $recipe->getById($id);

		if(count($_POST) > 0 && Auth::i_own_content($recipe->getUserId()))
 		{
			$step = new Step();
			$step->deleteAllWithRecipeId($id);

			$quantity = new Quantity_model();
			$quantity->deleteAllQuantitiesWithIngredients($id);

			$recipe->deleteFromDb();

 			$this->redirect('recipes');
 		}

		if(Auth::i_own_content($recipe->getUserId())){

			$this->view("recipe.delete",['recipe'=>$recipe]);
		}else{
			$this->view('access-denied');
		}
	}

	function validateAll($recipe, $quantities, $ingredients, $steps){
		$result = true;
		if(!$recipe->isValid()) $result = false;

		foreach ($quantities as $row) {
			if(!$row->isValid()) $result = false;
		}

		foreach ($ingredients as $row) {
			if(!$row->isValid()) $result = false;
		}

		foreach ($steps as $row) {
			if(!$row->isValid()) $result = false;
		}
		return $result;
	}
}