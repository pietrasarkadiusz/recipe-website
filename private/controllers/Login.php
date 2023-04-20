<?php

/**
 * login controller
 */
class Login extends Controller
{
	
	function index()
	{
		$errors = array();

		if(count($_POST) > 0)
 		{

 			$user = new User();
 			if($user = $user->getByEmail($_POST['email']))
 			{

 				if(password_verify($_POST['password'], $user->getPassword()))
 				{
 					Auth::authenticate($user);
 					$this->redirect('/home');	
 				}
  			
 			}
  			
  			$errors['email'] = "Wrong email or password";

 		}

		$this->view('login',[
			'errors'=>$errors,
		]);
	}
}