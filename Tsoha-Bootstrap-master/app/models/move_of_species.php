<?php

  class MoveOfSpecies extends BaseModel{

    // attribuutit
	public $id, $species_id, $move_id;
	
	
	// konstruktori
	public function __construct($attributes){
		parent::__construct($attributes);
	}
	
	
	public static function create($array){
		$sql = DB::query('INSERT INTO moves_of_species(move_id, species_id)
			VALUES (:move_id, :species_id) RETURNING id', $array);
		return $sql;
	}
	
	public static function destroy($species_id, $move_id){
		DB::query('DELETE FROM moves_of_species
			WHERE species_id = :species_id AND move_id = :move_id',
			array('species_id' => $species_id, 'move_id' => $move_id));
	}
	
	
	public static function all(){
		
		$junction = array();
		$rows = DB::query('SELECT * FROM moves_of_species');
		
		foreach($rows as $row){
			$junction[] = new MoveOfSpecies(array(
				'id' => $row['id'],
				'species_id' => $row['species_id'],
				'move_id' => $row['move_id']
			));
		}
		
		return $junction;
	}
	
	public static function findById($id){
		$rows = DB::query('SELECT * FROM moves_of_species WHERE id = :id LIMIT 1', array('id' => $id));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$junction[] = new MoveOfSpecies(array(
				'id' => $row['id'],
				'species_id' => $row['species_id'],
				'move_id' => $row['move_id']
			));
			
			return $junction;
		}
		
		return null;
	}
	
	public static function findBySpeciesId($species_id){
		$rows = DB::query('SELECT * FROM moves_of_species WHERE species_id = :species_id ', array('species_id' => $species_id));
		
		if(count($rows) > 0){
			
			foreach($rows as $row){
				$junction[] = new MoveOfSpecies(array(
				'id' => $row['id'],
				'species_id' => $row['species_id'],
				'move_id' => $row['move_id']
			));
			}
			
			return $junction;
		}
		
		return null;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  }
