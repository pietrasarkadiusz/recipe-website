<?php

/**
 * profile controller
 */
class Profile extends Controller
{
	
	function index($id = '')
	{

		$id = trim($id == '') ? Auth::getId() : $id;

		$user = new User();
		$recipe = new Recipe_model();
		
		$data['recipes'] = $recipe->getAllByUserId($id);
		$data['user'] = $user->getById($id);
		
		$this->view('profile',$data);
		
	}

	function edit($id = '')
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();

		$id = trim($id == '') ? Auth::getId() : $id;

		$user = new User();
		$user = $user->getById($id);
  
		if(count($_POST) > 0 && Auth::i_own_content($user->getId()))
		{
			$user->setFirstName($_POST['firstname']);
			$user->setLastName($_POST['lastname']);
			$user->setEmail($_POST['email']);
			$user->setPermission($_POST['permission']);

			//check if passwords exist
			if(trim($_POST['password']) != "")
			{
				$user->setPassword($_POST['password']);
				$user->hashPassword();
			}

			if($user->isValid($_POST['repeatedPassword']))
 			{
 				//check for files
 				if($myimage = upload_image($_FILES))
 				{
 					$user->setImage($myimage);
 				}

 				if($_POST['permission'] == 'super_admin' && $_SESSION['USER']->permission != 'super_admin')
				{
					$user->setPermission('admin');
				}

				$user->updateInDb();
 
 				$redirect = 'profile/edit/'.$id;
 				$this->redirect($redirect);
 			}else
 			{
 				//errors
 				$errors = $user->getErrors();
 			}
		}

		$data['user'] = $user;
		$data['errors'] = $errors;

		if(Auth::i_own_content($user->getId())){
			$this->view('profile.edit',$data);
		}else{
			$this->view('access-denied');
		}

	}

	function delete($id = '')
	{
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$user = new User();
		$user = $user->getById($id);

		if(count($_POST) > 0 && Auth::i_own_content($id))
		{
			$step = new Step();
			$recipes = new Recipe_model();
			$quantity = new Quantity_model();

			$recipes = $recipes->getAllByUserId($id);
			if($recipes){
				foreach ($recipes as $recipe) {
					$step->deleteAllWithRecipeId($recipe->getId());
					$quantity->deleteAllQuantitiesWithIngredients($recipe->getId());
					$recipe->deleteFromDb();
				}
			}
			$user->deleteFromDb();
			if($id == Auth::getId()){
				Auth::logout();
			}
			$this->redirect('users');		
		}

		if(Auth::i_own_content($id)){
			$this->view('profile.delete',[
				'user'=>$user,
			]);
		}else{
			$this->view('access-denied');
		}
	}
}