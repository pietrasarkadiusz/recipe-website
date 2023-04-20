<?php

/**
 * recipes controller
 */
class Recipes extends Controller
{
	
	function index()
	{
		$limit = 9;
		$pager = new Pager($limit);
		$offset = $pager->offset;

		$recipe = new Recipe_model();

		if(isset($_GET['find']))
 		{
 			$find = '%' . $_GET['find'] . '%';
			$data = $recipe->findByName($find,$limit,$offset);
 		}else{
			$data = $recipe->getAll($limit,$offset);
		}

		$this->view('recipes',[
			'recipes'=>$data,
			'pager'=>$pager
		]);
	}
}