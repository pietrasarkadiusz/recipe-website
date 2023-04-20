<?php 

function get_var($key,$default = "")
{
	if(isset($_POST[$key]))
	{
		return $_POST[$key];
	}

	return $default;
}

function get_var_md($row,$column,$key,$default = "")
{
	if(isset($_POST[$row][$column][$key]))
	{
		return $_POST[$row][$column][$key];
	}

	return $default;
}

function check_select($key,$value, $default='')
{
	if(isset($_POST[$key]))
	{
		if($_POST[$key] == $value)
		{
			return "selected";
		}
	}elseif($default != '' && $value == $default){
		return "selected";
	}

	return "";
}

function check_select_when_equal($val1, $val2)
{
		if($val1 == $val2)
		{
			return "selected";
		}
	return "";
}

function check_select_measurements($column,$value,$default='')  
{
	if(isset($_POST['measurements'][$column]['measurement_id']))
	{
		if($_POST['measurements'][$column]['measurement_id'] == $value)
		{
			return "selected";
		}
	}elseif($default != '' && $value == $default){
		return "selected";
	}

	return "";
}

function esc($var)
{
	//return htmlspecialchars($var);
	return $var;
}

function get_date($date)
{

	return date("jS M, Y",strtotime($date));
}

function show($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function get_image($image,$type='recipe')
{
	if(!file_exists($image)){
		if($type=='recipe'){
 		$image = ASSETS.'/no_recipe.png';
		}else
		{
			$image = ASSETS.'/no_profile.jpg';
		}
 	}else
 	{
 		$class = new Image();
 		$image = ROOT . "/" . $class->profile_thumb($image);  
 	}

 	return $image;
}

function views_path($view)
{
	if(file_exists("../private/views/" . $view . ".inc.php"))
	{
		return ("../private/views/" . $view . ".inc.php");
	}else{
		return ("../private/views/404.view.php");
	}
}


function upload_image($FILES)
{
	if(count($FILES) > 0)
	{

		//we have an image
		$allowed[] = "image/jpeg";
		$allowed[] = "image/png";

		if($FILES['image']['error'] == 0 && in_array($FILES['image']['type'], $allowed))
		{
			$folder = "uploads/";
			if(!file_exists($folder)){
				mkdir($folder,0777,true);
			}
			$destination = $folder . time() . "_" . $FILES['image']['name'];
			move_uploaded_file($FILES['image']['tmp_name'], $destination);
			return $destination;
		}
		
	}

	return false;
}

