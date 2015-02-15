<?php

  class Species extends BaseModel{
	  
  
  
  /*
	id SERIAL NOT NULL PRIMARY KEY
	name varchar(50) UNIQUE NOT NULL
	dexno integer UNIQUE NOT NULL
	type1 pokemon_type NOT NULL
	type2 pokemon_type
	ability1 varchar(20) NOT NULL
	ability2 varchar(20)
	hability1 varchar(20)
	hability2 varchar(20)
	base_hp integer NOT NULL
	base_atk integer NOT NULL
	base_def integer NOT NULL
	base_satk integer NOT NULL
	base_sdef integer NOT NULL
	base_speed integer NOT NULL
  */
  
  //attribuutit
  public $id, $name, $dexno, $type1, $type2, $ability1, $ability2, $hability1, $hability2,
  $base_hp, $base_atk, $base_def, $base_satk, $base_sdef, $base_speed;
  
  // konstruktori
	public function __construct($attributes){
		parent::__construct($attributes);
		
		
		$this->validators = array('validate_type1', 'validate_type2', 'validate_abilities', 'validate_stats');
		
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
	
	public function validate_dex(){
		$errors = array();
		
		//tyhjä
		if($this->dexno == '' || $this->dexno == null){
			$errors[] = 'Dex number field may not be empty!';
		}
		
		//uniikki
		$dexarray = $this->findByDex($this->dexno);
		if(count($dexarray) > 0){
			$errors[] = 'Dex number must be unique!';
		}
		
		return $errors;
	}
	
	
	public function validate_type1(){
		$errors = array();
		
		if($this->type1 == '' || $this->type1 == null){
			$errors[] = 'Primary type field may not be empty!';
			return $errors;
		}
		
		$eTypes = array('Normal', 'Fire', 'Fighting', 'Water', 'Flying', 
		'Grass', 'Poison', 'Electric', 'Ground', 'Psychic', 'Rock', 'Ice', 
		'Bug', 'Dragon', 'Ghost', 'Dark', 'Steel', 'Fairy');
		$test = in_array($this->type1, $eTypes);
		
		if($test == False){
			$errors[] = 'Primary type syntax is incorrect! Make sure it is capitalized and typed correctly. eg. Dragon';
		}
		
		return $errors;
	}
	
	public function validate_type2(){
		$errors = array();
		
		if($this->type2 == '' || $this->type2 == null){
			return $errors;
		}
		
		$eTypes = array('Normal', 'Fire', 'Fighting', 'Water', 'Flying', 
		'Grass', 'Poison', 'Electric', 'Ground', 'Psychic', 'Rock', 'Ice', 
		'Bug', 'Dragon', 'Ghost', 'Dark', 'Steel', 'Fairy');
		$test = in_array($this->type2, $eTypes);
		
		if($test == False){
			$errors[] = 'Secondary type syntax is incorrect! Make sure it is capitalized and typed correctly. eg. Steel';
		}
		
		return $errors;
	}
	
	public function validate_abilities(){
		$errors = array();
		
		if($this->ability1 == '' || $this->ability1 == null){
			$errors[] = 'Primary ability field may not be empty!';
			return $errors;
		}
		
		return $errors;
	}
	
	public function validate_stats(){
		$errors = array();
		
		if($this->base_hp == '' || $this->base_hp == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		if($this->base_atk == '' || $this->base_atk == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		if($this->base_def == '' || $this->base_def == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		if($this->base_satk == '' || $this->base_satk == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		if($this->base_sdef == '' || $this->base_sdef == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		if($this->base_speed == '' || $this->base_speed == null){
			$errors[] = 'None of the base stats may be empty!';
			return $errors;
		}
		
		if(!is_numeric($this->base_hp) || !is_numeric($this->base_atk) || !is_numeric($this->base_def) ||
		  !is_numeric($this->base_satk) || !is_numeric($this->base_sdef) || !is_numeric($this->base_speed)){
			$errors[] = 'Base stats must be numerical!';
		}
		
		
		if($this->base_hp < 0 || $this->base_atk < 0 || $this->base_def < 0 ||
		  $this->base_satk < 0 || $this->base_sdef < 0 || $this->base_speed < 0){
			$errors[] = 'Base stats must be positive!';
		}
		
		
		return $errors;
	}
	
	
	/*
		nullit eivät ole kivoja
	*/
	public static function create($array){
		
		$sql = 'INSERT INTO species(name, dexno, type1, type2, ability1, ability2, hability1, hability2,
										base_hp, base_atk, base_def, base_satk, base_sdef, base_speed)
										VALUES(:name, :dexno, :type1, :type2, :ability1, :ability2, :hability1, :hability2,
										:base_hp, :base_atk, :base_def, :base_satk, :base_sdef, :base_speed) RETURNING id';
		
		$connection = DB::connection();
		$preparation = $connection->prepare($sql);
		
		$preparation->bindParam(':name', $array['name'], PDO::PARAM_STR);
		$preparation->bindParam(':dexno', $array['dexno'], PDO::PARAM_INT);
		$preparation->bindParam(':type1', $array['type1'], PDO::PARAM_STR);
		
		if(empty($array['type2'])){
			$preparation->bindValue(':type2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':type2', $array['type2'], PDO::PARAM_STR);
		}
		
		$preparation->bindParam(':ability1', $array['ability1'], PDO::PARAM_STR);
		
		if(empty($array['ability2'])){
			$preparation->bindValue(':ability2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':ability2', $array['ability2'], PDO::PARAM_STR);
		}
		
		if(empty($array['hability1'])){
			$preparation->bindValue(':hability1', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':hability1', $array['hability1'], PDO::PARAM_STR);
		}
		
		if(empty($array['hability2'])){
			$preparation->bindValue(':hability2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':hability2', $array['hability2'], PDO::PARAM_STR);
		}
		
		$preparation->bindParam(':base_hp', $array['base_hp'], PDO::PARAM_INT);
		$preparation->bindParam(':base_atk', $array['base_atk'], PDO::PARAM_INT);
		$preparation->bindParam(':base_def', $array['base_def'], PDO::PARAM_INT);
		$preparation->bindParam(':base_satk', $array['base_satk'], PDO::PARAM_INT);
		$preparation->bindParam(':base_sdef', $array['base_sdef'], PDO::PARAM_INT);
		$preparation->bindParam(':base_speed', $array['base_speed'], PDO::PARAM_INT);
		
        try{
            $preparation->execute();
        } catch (Exception $e){
          die('Virhe tietokantakyselyssä: ' . $e->getMessage());
        }
		
		return $preparation->fetchAll();
	}
	
	
	/*
		nullit eivät ole kivoja
	*/
	public static function update($id, $array){
		
		$sql = 'UPDATE species SET
				   type1 = :type1,
				   type2 = :type2,
				   ability1 = :ability1,
				   ability2 = :ability2,
				   hability1 = :hability1,
				   hability2 = :hability2,
				   base_hp = :base_hp,
				   base_atk = :base_atk,
				   base_def = :base_def,
				   base_satk = :base_satk,
				   base_sdef = :base_sdef,
				   base_speed = :base_speed
				   WHERE id = :id';
		
		$connection = DB::connection();
		$preparation = $connection->prepare($sql);
		
		
		$preparation->bindParam(':type1', $array['type1'], PDO::PARAM_STR);
		
		if(empty($array['type2'])){
			$preparation->bindValue(':type2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':type2', $array['type2'], PDO::PARAM_STR);
		}
		
		$preparation->bindParam(':ability1', $array['ability1'], PDO::PARAM_STR);
		
		if(empty($array['ability2'])){
			$preparation->bindValue(':ability2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':ability2', $array['ability2'], PDO::PARAM_STR);
		}
		
		if(empty($array['hability1'])){
			$preparation->bindValue(':hability1', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':hability1', $array['hability1'], PDO::PARAM_STR);
		}
		
		if(empty($array['hability2'])){
			$preparation->bindValue(':hability2', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':hability2', $array['hability2'], PDO::PARAM_STR);
		}
		
		$preparation->bindParam(':base_hp', $array['base_hp'], PDO::PARAM_INT);
		$preparation->bindParam(':base_atk', $array['base_atk'], PDO::PARAM_INT);
		$preparation->bindParam(':base_def', $array['base_def'], PDO::PARAM_INT);
		$preparation->bindParam(':base_satk', $array['base_satk'], PDO::PARAM_INT);
		$preparation->bindParam(':base_sdef', $array['base_sdef'], PDO::PARAM_INT);
		$preparation->bindParam(':base_speed', $array['base_speed'], PDO::PARAM_INT);
		$preparation->bindParam(':id', $id, PDO::PARAM_INT);
		
		
        try{
            $preparation->execute();
        } catch (Exception $e){
          die('Virhe tietokantakyselyssä: ' . $e->getMessage());
        }
		
		
	}
	
	
	public static function destroy($id){
		DB::query('DELETE FROM species WHERE id = :id', array('id' => $id));
	}
	
	
	public static function all(){
		
		$species = array();
		$rows = DB::query('SELECT * FROM species');
		
		foreach($rows as $row){
			$species[] = new Species(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'dexno' => $row['dexno'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'ability1' => $row['ability1'],
				'ability2' => $row['ability2'],
				'hability1' => $row['hability1'],
				'hability2' => $row['hability2'],
				'base_hp' => $row['base_hp'],
				'base_atk' => $row['base_atk'],
				'base_def' => $row['base_def'],
				'base_satk' => $row['base_satk'],
				'base_sdef' => $row['base_sdef'],
				'base_speed' => $row['base_speed']
			));
		}
		
		return $species;
	}
	
	public static function findById($id){
		$rows = DB::query('SELECT * FROM species WHERE id = :id LIMIT 1', array('id' => $id));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$species = new Species(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'dexno' => $row['dexno'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'ability1' => $row['ability1'],
				'ability2' => $row['ability2'],
				'hability1' => $row['hability1'],
				'hability2' => $row['hability2'],
				'base_hp' => $row['base_hp'],
				'base_atk' => $row['base_atk'],
				'base_def' => $row['base_def'],
				'base_satk' => $row['base_satk'],
				'base_sdef' => $row['base_sdef'],
				'base_speed' => $row['base_speed']
			));
			
			return $species;
		}
		
		return null;
	}
	
	public static function findByDex($dexno){
		$rows = DB::query('SELECT * FROM species WHERE dexno = :dexno LIMIT 1', array('dexno' => $dexno));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$species = new Species(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'dexno' => $row['dexno'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'ability1' => $row['ability1'],
				'ability2' => $row['ability2'],
				'hability1' => $row['hability1'],
				'hability2' => $row['hability2'],
				'base_hp' => $row['base_hp'],
				'base_atk' => $row['base_atk'],
				'base_def' => $row['base_def'],
				'base_satk' => $row['base_satk'],
				'base_sdef' => $row['base_sdef'],
				'base_speed' => $row['base_speed']
			));
			
			return $species;
		}
		
		return null;
	}
	
	public static function findByName($name){
		$rows = DB::query('SELECT * FROM move WHERE name = :name LIMIT 1', array('name' => $name));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$move = new Species(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'dexno' => $row['dexno'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'ability1' => $row['ability1'],
				'ability2' => $row['ability2'],
				'hability1' => $row['hability1'],
				'hability2' => $row['hability2'],
				'base_hp' => $row['base_hp'],
				'base_atk' => $row['base_atk'],
				'base_def' => $row['base_def'],
				'base_satk' => $row['base_satk'],
				'base_sdef' => $row['base_sdef'],
				'base_speed' => $row['base_speed']
			));
			
			return $species;
		}
		
		return null;
	}
  }