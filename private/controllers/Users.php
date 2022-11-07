<?php

/**
 * users controller
 */
class Users extends Controller
{
	
	function index()
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		if(Auth::access('admin') || Auth::access('super_admin'))
		{
		$user = new User();
		$limit = 10;
		$pager = new Pager($limit);
		$offset = $pager->offset;
		
		if(isset($_GET['find']))
 		{
 			$find = '%' . $_GET['find'] . '%';
			$data = $user->findByFirstOrLastName($find,$limit,$offset);
 		}else{
			$data = $user->getAll($limit,$offset);
		}
		$this->view('users',['users'=>$data, 'pager'=>$pager]);
		}else{
			$this->view('access-denied');
		}

	}
}