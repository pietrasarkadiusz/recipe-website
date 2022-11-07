<?php

/**
 * User Model
 */
class User extends Model
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $permission;
    private $date;
    private $image;
    public $errors = array();

    public function __construct($firstname=null, $lastname=null, $email=null, $password = null,$image='', $id = null)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->email = $email;
        $this->image = $image;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setPermission($permission)
    {
        $this->permission =$permission;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getFullName(){
        return "$this->firstname"." "."$this->lastname";
    }

    public function isValid($repeatedPassword)
    {
        $this->errors = array();

        //check for first name
        if(empty($this->firstname) || !preg_match('/^[a-zA-Z]+$/', $this->firstname))
        {
            $this->errors['firstname'] = "Only letters allowed in first name";
        }

        //check for last name
        if(empty($this->lastname) || !preg_match('/^[a-zA-Z]+$/', $this->lastname))
        {
            $this->errors['lastname'] = "Only letters allowed in last name";
        }

        //check for email
        if(empty($this->email) || !filter_var($this->email,FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }
        
        //check if email exists
        if($this->id == null){
            if($this->getByEmail($this->email))
            {
                $this->errors['email'] = "That email is already in use";
            }
        }else{
            if($this->queryNew("select email from users where email = :email && id != :id",'User',['email'=>$this->email,'id'=>$this->id]))
            {
                $this->errors['email'] = "That email is already in use";
            }
        }

        //check for password
        if($this->id==null){

            if(empty($this->password) || $this->password !== $repeatedPassword)
            {
                $this->errors['password'] = "Passwords do not match";
            }

            //check for password length
            if(strlen($this->password) < 8)
            {
                $this->errors['password'] = "Password must be at least 8 characters long";
            }
        }

        return count($this->errors) === 0;
    }

    public function insertToDb()
	{
        $data['firstname'] = $this->firstname;
        $data['lastname'] = $this->lastname;
        $data['email'] = $this->email;
        $data['password'] = $this->password;
        $data['permission'] = $this->permission;
        $data['date'] = $this->date;
        $data['image'] = $this->image;

		return $this->insert('users',$data);
	}

    public function updateInDb()
	{
        $data['firstname'] = $this->firstname;
        $data['lastname'] = $this->lastname;
        $data['email'] = $this->email;
        $data['password'] = $this->password;
        $data['permission'] = $this->permission;
        $data['date'] = $this->date;
        $data['image'] = $this->image;

		return $this->update('users',$this->id,$data);
	}

    public function deleteFromDb()
    {
        return $this->delete('users', $this->id);
    }

    public function findByFirstOrLastName($name, $limit, $offset){
        $query = "select * from users where firstname like :name || lastname like :name order by id desc limit $limit offset $offset";
	 	$data['name'] = $name;
        return $this->queryNew($query,'User',$data);
    }

    public function getById($id){
        return $this->getFirstByColumn('users', 'id', $id, 'User');
    }

    public function getByEmail($email){
        return $this->getFirstByColumn('users', 'email', $email, 'User');
    }

    public function getAll($limit, $offset){
        return $this->getAllFromDb('users','User','desc',$limit, $offset);
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

}