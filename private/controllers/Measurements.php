<?php


/**
 * measurements controller
 */
class Measurements extends Controller
{
	
	public function index()
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$measurements = new Measurement_model();
		
		if(isset($_GET['find']))
	 	{
	 		$find = '%' . $_GET['find'] . '%';
            $data = $measurements->findByName($find);
	 	}else{
            $data = $measurements->getAll();
        }			

		$this->view('measurements',[
			'measurements'=>$data
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

			$measurement = new Measurement_model($_POST['name']);

			if($measurement->isValid())
 			{

 				$measurement->insertToDb();
 				$this->redirect('measurements');
 			}else
 			{
 				//errors
 				$errors = $measurement->getErrors();
 			}
 		}

		if(Auth::access('admin')){
			$this->view('measurements.add',[
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

		$measurement = new Measurement_model();
 		$measurement = $measurement->getById($id);

		$errors = array();
		if(count($_POST) > 0 && Auth::access('admin'))
 		{
			$measurement->setName($_POST['name']);

			if($measurement->isValid())
 			{
 				$measurement->updateInDb();
 				$this->redirect('measurements');
 			}else
 			{
 				//errors
 				$errors = $measurement->getErrors();
 			}
 		}

		if(Auth::access('admin')){
			$this->view('measurements.edit',[
				'measurement'=>$measurement,
				'errors'=>$errors,
			]);
		}else{
			$this->view('access-denied');
		}
	}

	public function delete($id = '')
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$measurement = new Measurement_model();
 		$measurement = $measurement->getById($id);

		if(count($_POST) > 0 && Auth::access('admin'))
 		{
			$recipes = new Recipe_model;
			$quantity = new Quantity_model();
			$step = new Step();
			$recipes = $recipes->getAllWithMeasurement($id);

			if($recipes){
				foreach ($recipes as $recipe) {
					$step->deleteAllWithRecipeId($recipe->getId());
					$quantity->deleteAllQuantitiesWithIngredients($recipe->getId());
					$recipe->deleteFromDb();
				}
			}
 			$measurement->deleteFromDb();

 			$this->redirect('measurements');
 		}

		if(Auth::access('admin')){
			$this->view('measurements.delete',[
				'measurement'=>$measurement,
			]);
		}else{
			$this->view('access-denied');
		}
	}
	
}