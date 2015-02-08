<?php

  class User extends BaseModel{

    public $id, $name, $password;
	
	public function __construct($attributes){
		parent::__construct($attributes);
		
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
	
  }
