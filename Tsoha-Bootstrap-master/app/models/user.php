<?php

  class User extends BaseModel{

    public $id, $name, $password;
	
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_pw');	
	}
	
	public function validate_name(){
		$errors = array();
		
		if($this->name == '' || $this->name == null){
			$errors[] = 'Username may not be empty!';
		}
		
		$namearray = $this->findByName($this->name);
		if(count($namearray) > 0){
			$errors[] = 'Username already exists!';
		}
		
		return $errors;
	}
	
	public function validate_pw(){
		$errors = array();
		
		if($this->password == '' || $this->password == null){
			$errors[] = 'Password field may not be empty!';
		}
		
		return $errors;
	}
	
	public static function create($array){
		$sql = DB::query('INSERT INTO patron(name, password)
			VALUES(:name, :password) RETURNING id', $array);
		return $sql;
	}
	
	public static function authenticate($name, $password){
		$rows = DB::query('SELECT * FROM patron WHERE name = :name AND password = :password LIMIT 1', array('name' => $name, 'password' => $password));
		if (count($rows) > 0){
			$row = $rows[0];
			
			$user = new User(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password']));
			
			
			return $user;
			
			
		}
		return false;
	}
	
	public static function findById($id){
		$rows = DB::query('SELECT * FROM patron WHERE id = :id LIMIT 1', array('id' => $id));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$user = new User(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password']));
			
			return $user;
		}
		
		return null;
	}
	
	public static function findByName($name){
		$rows = DB::query('SELECT * FROM patron WHERE name = :name LIMIT 1', array('name' => $name));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$user = new User(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password']));
			
			return $user;
		}
		
		return null;
		
	}
	
  }
