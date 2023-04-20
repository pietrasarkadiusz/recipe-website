<?php


/**
 * categories controller
 */
class Categories extends Controller
{
	
	public function index()
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$categories = new Category();
		
		if(isset($_GET['find']))
	 	{
	 		$find = '%' . $_GET['find'] . '%';
            $data = $categories->findByName($find);
	 	}else{
            $data = $categories->getAll();
        }			

		$this->view('categories',[
			'categories'=>$data
		]);
	}

	public function add()
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();
		if(count($_POST) > 0)
 		{

			$category = new Category($_POST['name']);

			if($category->isValid())
 			{
 				
 				$category->insertToDb();
 				$this->redirect('categories');
 			}else
 			{
 				//errors
 				$errors = $category->getErrors();
 			}
 		}
		
		if(Auth::access('admin')){
			$this->view('categories.add',[
				'errors'=>$errors,
		]);
		}else{
			$this->view('access-denied');
		}
	}

	public function edit($id = '')
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$category = new Category();
		$category = $category->getById($id);

		$errors = array();
		if(count($_POST) > 0 && Auth::access('admin'))
 		{

			$category->setName($_POST['name']);

			if($category->isValid())
 			{
 				
 				$category->updateInDb();
 				$this->redirect('categories');
 			}else
 			{
 				//errors
 				$errors = $category->getErrors();
 			}
 		}

		if(Auth::access('admin')){
			$this->view('categories.edit',[
				'category'=>$category,
				'errors'=>$errors,
			]);
		}else{
			$this->view('access-denied');
		}
	}

	public function delete($id = '')
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$category = new Category();
		$category = $category->getById($id);

		if(count($_POST) > 0 && Auth::access('admin'))
 		{
			$recipes = new Recipe_model;
			$quantity = new Quantity_model();
			$step = new Step();
			$recipes = $recipes->getAllWithCategory($id);

			if($recipes){
				foreach ($recipes as $recipe) {
					$step->deleteAllWithRecipeId($recipe->getId());
					$quantity->deleteAllQuantitiesWithIngredients($recipe->getId());
					$recipe->deleteFromDb();
				}
			}
 
 			$category->deleteFromDb();

 			$this->redirect('categories');
 		}

		if(Auth::access('admin')){
			$this->view('categories.delete',[
				'category'=>$category,
			]);
		}else{
			$this->view('access-denied');
		}
	}
	
}