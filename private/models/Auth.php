<?php

/**
 * Authentication class
 */
class Auth
{
	
	public static function authenticate($user)
	{
		$_SESSION['USER'] = [
			'id' => $user->getId(),
			'firstname' => $user->getFirstName(),
			//'lastname' => $user->getLastName(),
			//'email' => $user->getEmail(),
			'permission' => $user->getPermission()
		];
	}

	public static function logout()
	{
		if(isset($_SESSION['USER']))
		{
			unset($_SESSION['USER']);
		}
	}

	public static function logged_in()
	{
		if(isset($_SESSION['USER']))
		{
			return true;
		}

		return false;
	}

	public static function user()
	{
		if(isset($_SESSION['USER']))
		{
			return $_SESSION['USER']['firstname'];
		}

		return false;
	}

	public static function __callStatic($method,$params)
	{
		$prop = strtolower(str_replace("get","",$method));

		if(isset($_SESSION['USER'][$prop]))
		{
			return $_SESSION['USER'][$prop];
		}

		return 'Unknown';
	}

	public static function access($permission = 'user')
	{
		if(!isset($_SESSION['USER']))
		{
			return false;
		}

		$logged_in_permission = $_SESSION['USER']['permission'];

		$PERMISSION['super_admin'] = ['super_admin','admin','lecturer','reception','student'];
		$PERMISSION['admin'] = ['admin','lecturer','reception','student'];
		$PERMISSION['user'] = ['user'];

		if(!isset($PERMISSION[$logged_in_permission]))
		{
			return false;
		}

		if(in_array($permission,$PERMISSION[$logged_in_permission]))
		{
			return true;
		}

		return false;
	}

	public static function i_own_content2($row)
	{

		if(is_array($row))
		{
			$row = $row[0];
		}
		
		if(!isset($_SESSION['USER']))
		{
			return false;
		}

		if(isset($row->id)){

			if($_SESSION['USER']->id == $row->id){
				return true;
			}
		}

		$allowed[] = 'super_admin';
		$allowed[] = 'admin';

		if(in_array($_SESSION['USER']->permission,$allowed)){
			return true;
		}

		return false;
	}	

	public static function i_own_content($user_id)
	{
		
		if(!isset($_SESSION['USER']))
		{
			return false;
		}

		if($_SESSION['USER']['id'] == $user_id){
			return true;
		}

		$allowed[] = 'super_admin';
		$allowed[] = 'admin';

		if(in_array($_SESSION['USER']['permission'],$allowed)){
			return true;
		}

		return false;
	}	

}

	