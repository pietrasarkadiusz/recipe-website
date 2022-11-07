<?php

/**
 * login controller
 */
class Signup extends Controller
{
	
	function index()
	{
		// code...
		$errors = array();
 		if(count($_POST) > 0)
 		{

 			$user = new User($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password']);
			
 			if($user->isValid($_POST['repeatedPassword']))
 			{
 				$user->setDate(date("Y-m-d H:i:s"));

				if (!isset($_POST['permission'])) {
					$_POST['permission']='user';
				}

				$user->setPermission('user');

				$user->hashPassword();
				$user->insertToDb();
				
				if(Auth::logged_in()){
					$this->redirect('users');
				}else $this->redirect('login');
 			}else
 			{
 				//errors
 				$errors = $user->getErrors();
 			}
 		}

		$this->view('signup',[
			'errors'=>$errors,
		]);
	}
}