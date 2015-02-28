<?php

  class Move extends BaseModel{

    // attribuutit
	public $id, $name, $type, $category, $power, $accuracy, $pp, $description;
	
	
	// konstruktori
	public function __construct($attributes){
		parent::__construct($attributes);
		
		
		$this->validators = array('validate_type', 'validate_category', 'validate_power',
		'validate_accuracy', 'validate_pp', 'validate_description');
	}
	
	
	public function validate_name(){
		$errors = array();
		
		//tyhjä
		if($this->name == '' || $this->name == null){
			$errors[] = 'Name field may not be empty!';
		}
		
		//uniikki
		$namearray = $this->findByName($this->name);
		if(count($namearray) > 0){
			$errors[] = 'Name must be unique!';
		}
		
		return $errors;
	}
	
	/* nimeä ei voi enää muokata, niin tätä ei tarvita
	public function validate_name_edit($id){
		$errors = array();
		
		//tyhjä
		if($this->name == '' || $this->name == null){
			$errors[] = 'Name field may not be empty!';
		}
		
		if($rows[0]['id'] != $id){
			$namearray = $this->findByName($this->name);
		    if($namearray[0]['id'] != $id){
		    	$errors[] = 'Name must be unique!';
		    }
		}
		
		
		return $errors;
	}
	*/
	
	public function validate_type(){
		$errors = array();
		
		if($this->type == '' || $this->type == null){
			$errors[] = 'Type field may not be empty!';
			return $errors;
		}
		
		$eTypes = array('Normal', 'Fire', 'Fighting', 'Water', 'Flying', 
		'Grass', 'Poison', 'Electric', 'Ground', 'Psychic', 'Rock', 'Ice', 
		'Bug', 'Dragon', 'Ghost', 'Dark', 'Steel', 'Fairy');
		$test = in_array($this->type, $eTypes);
		
		
		if($test == False){
			$errors[] = 'Type syntax is incorrect! Make sure it is capitalized and typed correctly. eg. Water';
		}
		
		
		return $errors;
	}
	
	public function validate_category(){
		$errors = array();
		
		if($this->category == '' || $this->category == null){
			$errors[] = 'Category field may not be empty!';
			return $errors;
		}
		
		$eCategories = array('Physical', 'Special', 'Status');
		$test = in_array($this->category, $eCategories);
		
		if($test == False){
			$errors[] = 'Category is incorrect! Insert one of the following: Physical, Special, Status';
		}
		
		return $errors;
	}
	
	
	public function validate_power(){
		$errors = array();
		
		
		if($this->power == '' || $this->power == null){
			$errors[] = 'Power may not be empty!';
			return $errors;
		}
		
		if($this->power < 0){
			$errors[] = 'Power may not be negative!';
		}
		
		if(!is_numeric($this->power)){
			$errors[] = 'Power must be a number!';
		}
		
		return $errors;
	}
	
	
	public function validate_accuracy(){
		$errors = array();
		
		if($this->accuracy == '' || $this->accuracy == null){
			$errors[] = 'Accuracy may not be empty!';
			return $errors;
		}
		
		if($this->accuracy > 100){
			$errors[] = 'Accuracy may not be greater than 100!';
		}
		
		if($this->accuracy < 0){
			$errors[] = 'Accuracy may not be negative!';
		}
		
		if(!is_numeric($this->accuracy)){
			$errors[] = 'Accuracy must be a number!';
		}
		
		return $errors;
	}
	
	public function validate_pp(){
		$errors = array();
		
		if($this->pp < 0){
			$errors[] = 'PP may not be negative!';
		}
		
		if($this->pp == '' || $this->pp == null){
			$errors[] = 'PP may not be empty!';
			return $errors;
		}
		
		if(!is_numeric($this->pp)){
			$errors[] = 'PP must be a number!';
		}
		
		return $errors;
	}
	
	public function validate_description(){
		$errors = array();
		if($this->description == '' || $this->description == null){
			$errors[] = 'Description may not be empty!';
		}
		return $errors;
	}
	
	public static function create($array){
		
		$sql = DB::query('INSERT INTO move(name, type, category, power, accuracy, pp, description)
			VALUES(:name, :type, :category, :power, :accuracy, :pp, :description) RETURNING id', $array);
		return $sql;
	}
	
	public static function update($id, $array){
		
		$merge = array_merge($array, array('id' => $id));
		DB::query('UPDATE move SET type = :type, category = :category,
			power = :power, accuracy = :accuracy, pp = :pp, description = :description
			WHERE id = :id', $merge);
		
	}
	
	public static function destroy($id){
		DB::query('DELETE FROM move WHERE id = :id', array('id' => $id));
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
