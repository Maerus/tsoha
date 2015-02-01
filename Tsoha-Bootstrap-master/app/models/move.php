<?php

  class Move extends BaseModel{

    // attribuutit
	public $id, $name, $type, $category, $power, $accuracy, $pp, $description;
	
	// konstruktori
	public function __construct($attributes){
		parent::__construct($attributes);
	}
	
	public static function create($array){
		
		$sql = DB::query('INSERT INTO move(name, type, category, power, accuracy, pp, description)
			VALUES(:name, :type, :category, :power, :accuracy, :pp, :description) RETURNING id', $array);
		$id = $sql[0]['id'];
		return $id;
	}
	
	public static function all(){
		
		$moves = array();
		$rows = DB::query('SELECT * FROM move');
		
		foreach($rows as $row){
			$moves[] = new Move(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'category' => $row['category'],
				'power' => $row['power'],
				'accuracy' => $row['accuracy'],
				'pp' => $row['pp'],
				'description' => $row['description'],
			));
		}
		
		return $moves;
	}
	
	public static function findById($id){
		$rows = DB::query('SELECT * FROM move WHERE id = :id LIMIT 1', array('id' => $id));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$move = new Move(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'category' => $row['category'],
				'power' => $row['power'],
				'accuracy' => $row['accuracy'],
				'pp' => $row['pp'],
				'description' => $row['description'],
			));
			
			return $move;
		}
		
		return null;
	}
	
	public static function findByName($name){
		$rows = DB::query('SELECT * FROM move WHERE name = :name LIMIT 1', array('name' => $name));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$move = new Move(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'category' => $row['category'],
				'power' => $row['power'],
				'accuracy' => $row['accuracy'],
				'pp' => $row['pp'],
				'description' => $row['description'],
			));
			
			return $move;
		}
		
		return null;
	}
	
	public static function findByType($type){
		$rows = DB::query('SELECT * FROM move WHERE type = :type', array('type' => $type));
		
		if(count($rows) > 0){
			
			foreach($rows as $row){
			$moves[] = new Move(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'category' => $row['category'],
				'power' => $row['power'],
				'accuracy' => $row['accuracy'],
				'pp' => $row['pp'],
				'description' => $row['description'],
			));
		}
			
			return $moves;
		}
		
		return null;
	}
	
	public static function findByCategory($category){
		$rows = DB::query('SELECT * FROM move WHERE category = :category', array('category' => $category));
		
		if(count($rows) > 0){
			
			foreach($rows as $row){
			$moves[] = new Move(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'category' => $row['category'],
				'power' => $row['power'],
				'accuracy' => $row['accuracy'],
				'pp' => $row['pp'],
				'description' => $row['description'],
			));
		}
			
			return $moves;
		}
		
		return null;
	}
	
  }
