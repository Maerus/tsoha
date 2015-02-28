<?php

  class Pokemon extends BaseModel{
	
	/*
	user_id integer REFERENCES patron(id) ON DELETE CASCADE,
	species_id integer REFERENCES species(id) ON DELETE CASCADE,
	id SERIAL NOT NULL PRIMARY KEY,
	nickname varchar(50) NOT NULL,
	gender pokemon_gender NOT NULL,
	ability varchar(20) NOT NULL,
	iv_hp integer CHECK(iv_hp < 32) CHECK(iv_hp > -1),
	iv_atk integer CHECK(iv_atk < 32) CHECK(iv_atk > -1),
	iv_def integer CHECK(iv_def < 32) CHECK(iv_def > -1),
	iv_satk integer CHECK(iv_satk < 32) CHECK(iv_satk > -1),
	iv_sdef integer CHECK(iv_sdef < 32) CHECK(iv_sdef > -1),
	iv_speed integer CHECK(iv_speed < 32) CHECK(iv_speed > -1),
	ev_hp integer CHECK(ev_hp < 253) CHECK(ev_hp > -1),
	ev_atk integer CHECK(ev_atk < 253) CHECK(ev_atk > -1),
	ev_def integer CHECK(ev_def < 253) CHECK(ev_def > -1),
	ev_satk integer CHECK(ev_satk < 253) CHECK(ev_satk > -1),
	ev_sdef integer CHECK(ev_sdef < 253) CHECK(ev_sdef > -1),
	ev_speed integer CHECK(ev_speed < 253) CHECK(ev_speed > -1),
	move1 integer REFERENCES move(id) ON DELETE SET DEFAULT,
	move2 integer REFERENCES move(id) ON DELETE SET DEFAULT,
	move3 integer REFERENCES move(id) ON DELETE SET DEFAULT,
	move4 integer REFERENCES move(id) ON DELETE SET DEFAULT
	*/
	
	//attribuutit
	public $id, $user_id, $species_id, $nickname, $gender, $ability,
		$iv_hp, $iv_atk, $iv_def, $iv_satk, $iv_sdef, $iv_speed,
		$ev_hp, $ev_atk, $ev_def, $ev_satk, $ev_sdef, $ev_speed,
		$move1, $move2, $move3, $move4,
		$species_name, $species_dexno, $species_type1, $species_type2;
	//species_name jne ovat attribuutteja, jotta niitä voidaan käyttää suoraan pokemon/show.html:ssä
	//käytetään findByUser metodin kautta, jossa käytetään INNER JOIN lauseketta
  
	// konstruktori
	public function __construct($attributes){
		parent::__construct($attributes);
		
		$this->validators = array('validate_nickname', 'validate_gender',
										'validate_iv_hp',
										'validate_iv_atk',
										'validate_iv_def',
										'validate_iv_satk',
										'validate_iv_sdef',
										'validate_iv_speed',
										'validate_ev_hp',
										'validate_ev_atk',
										'validate_ev_def',
										'validate_ev_satk',
										'validate_ev_sdef',
										'validate_ev_speed',
										'validate_ev_total');	
	}
	
	public function validate_nickname(){
		$errors = array();
		
		if($this->nickname == '' || $this->nickname == null){
			$errors[] = 'Please name your pokemon!';
		}
		
		return $errors;
	}
	
	public function validate_gender(){
		$errors = array();
		
		//saa olla null
		if($this->gender == '' || $this->gender == null){
			return $errors;
		}
		
		$eGender = array('Male', 'Female', 'Genderless');
		$test = in_array($this->gender, $eGender);
		
		if($test == False){
			$errors[] = 'Please type a correct gender: Male, Female or Genderless';
		}
		
		return $errors;
	}
	
	
		//0 - 31 tai null
		//$iv_hp, $iv_atk, $iv_def, $iv_satk, $iv_sdef, $iv_speed
	public function validate_iv_hp(){
		$errors = array();
		if($this->iv_hp == '' || $this->iv_hp == null){
			return $errors;
		}
		if(!is_numeric($this->iv_hp)){
			$errors[] = 'IV must be a number! (HP)';
		}
		if($this->iv_hp > 31){
			$errors[] = 'IV values may not be greater than 31! (HP)';
		}
		if($this->iv_hp < 0){
			$errors[] = 'IV and EV values may not be negative! (HP)';
		}
		return $errors;
	}
	public function validate_iv_atk(){
		$errors = array();
		if($this->iv_atk == '' || $this->iv_atk == null){
			return $errors;
		}
		if(!is_numeric($this->iv_atk)){
			$errors[] = 'IV must be a number! (Attack)';
		}
		if($this->iv_atk > 31){
			$errors[] = 'IV values may not be greater than 31! (Attack)';
		}
		if($this->iv_atk < 0){
			$errors[] = 'IV and EV values may not be negative! (Attack)';
		}
		return $errors;
	}
	public function validate_iv_def(){
		$errors = array();
		if($this->iv_def == '' || $this->iv_def == null){
			return $errors;
		}
		if(!is_numeric($this->iv_def)){
			$errors[] = 'IV must be a number! (Defence)';
		}
		if($this->iv_def > 31){
			$errors[] = 'IV values may not be greater than 31! (Defence)';
		}
		if($this->iv_def < 0){
			$errors[] = 'IV and EV values may not be negative! (Defence)';
		}
		return $errors;
	}
	public function validate_iv_satk(){
		$errors = array();
		if($this->iv_satk == '' || $this->iv_satk == null){
			return $errors;
		}
		if(!is_numeric($this->iv_satk)){
			$errors[] = 'IV must be a number! (Special Attack)';
		}
		if($this->iv_satk > 31){
			$errors[] = 'IV values may not be greater than 31! (Special Attack)';
		}
		if($this->iv_satk < 0){
			$errors[] = 'IV and EV values may not be negative! (Special Attack)';
		}
		return $errors;
	}
	public function validate_iv_sdef(){
		$errors = array();
		if($this->iv_sdef == '' || $this->iv_sdef == null){
			return $errors;
		}
		if(!is_numeric($this->iv_sdef)){
			$errors[] = 'IV must be a number! (Special Defence)';
		}
		if($this->iv_sdef > 31){
			$errors[] = 'IV values may not be greater than 31! (Special Defence)';
		}
		if($this->iv_sdef < 0){
			$errors[] = 'IV and EV values may not be negative! (Special Defence)';
		}
		return $errors;
	}
	public function validate_iv_speed(){
		$errors = array();
		if($this->iv_speed == '' || $this->iv_speed == null){
			return $errors;
		}
		if(!is_numeric($this->iv_speed)){
			$errors[] = 'IV must be a number! (Speed)';
		}
		if($this->iv_speed > 31){
			$errors[] = 'IV values may not be greater than 31! (Speed)';
		}
		if($this->iv_speed < 0){
			$errors[] = 'IV and EV values may not be negative! (Speed)';
		}
		return $errors;
	}
	
	//510 total effort values, 252 effort values in any stat. 
	//$ev_hp, $ev_atk, $ev_def, $ev_satk, $ev_sdef, $ev_speed
	public function validate_ev_hp(){
		$errors = array();
		
		if($this->ev_hp == '' || $this->ev_hp == null){
			return $errors;
		}
		if(!is_numeric($this->ev_hp)){
			$errors[] = 'EV must be a number! (HP)';
		}
		if($this->iv_hp > 252){
			$errors[] = 'EV values may not be greater than 252! (HP)';
		}
		if($this->ev_hp < 0){
			$errors[] = 'IV and EV values may not be negative! (HP)';
		}
		return $errors;
	}
	public function validate_ev_atk(){
		$errors = array();
		if($this->ev_atk == '' || $this->ev_atk == null){
			return $errors;
		}
		if(!is_numeric($this->ev_atk)){
			$errors[] = 'EV must be a number! (Attack)';
		}
		if($this->ev_atk > 252){
			$errors[] = 'EV values may not be greater than 252! (Attack)';
		}
		if($this->ev_atk < 0){
			$errors[] = 'IV and EV values may not be negative! (Attack)';
		}
		return $errors;
	}
	public function validate_ev_def(){
		$errors = array();
		if($this->ev_def == '' || $this->ev_def == null){
			return $errors;
		}
		if(!is_numeric($this->ev_def)){
			$errors[] = 'EV must be a number! (Defence)';
		}
		if($this->ev_def > 252){
			$errors[] = 'EV values may not be greater than 252! (Defence)';
		}
		if($this->ev_def < 0){
			$errors[] = 'IV and EV values may not be negative! (Defence)';
		}
		return $errors;
	}
	public function validate_ev_satk(){
		$errors = array();
		if($this->ev_satk == '' || $this->ev_satk == null){
			return $errors;
		}
		if(!is_numeric($this->ev_satk)){
			$errors[] = 'EV must be a number! (Special Attack)';
		}
		if($this->ev_satk > 252){
			$errors[] = 'EV values may not be greater than 252! (Special Attack)';
		}
		if($this->ev_satk < 0){
			$errors[] = 'IV and EV values may not be negative! (Special Attack)';
		}
		return $errors;
	}
	public function validate_ev_sdef(){
		$errors = array();
		if($this->ev_sdef == '' || $this->ev_sdef == null){
			return $errors;
		}
		if(!is_numeric($this->ev_sdef)){
			$errors[] = 'EV must be a number! (Special Defence)';
		}
		if($this->ev_sdef > 252){
			$errors[] = 'EV values may not be greater than 252! (Special Defence)';
		}
		if($this->ev_sdef < 0){
			$errors[] = 'IV and EV values may not be negative! (Special Defence)';
		}
		return $errors;
	}
	public function validate_ev_speed(){
		$errors = array();
		if($this->ev_speed == '' || $this->ev_speed == null){
			return $errors;
		}
		if(!is_numeric($this->ev_speed)){
			$errors[] = 'EV must be a number! (Speed)';
		}
		if($this->ev_speed > 252){
			$errors[] = 'EV values may not be greater than 252! (Speed)';
		}
		if($this->ev_speed < 0){
			$errors[] = 'IV and EV values may not be negative! (Speed)';
		}
		return $errors;
	}
	
	public function validate_ev_total(){
		$errors = array();
		
		$total = $this->ev_hp + $this->ev_atk + $this->ev_def 
					+ $this->ev_satk + $this->ev_sdef + $this->ev_speed;
		
		if($total > 510){
			$errors[] = 'EV values total may not exceed 510!';
		}
		
		
		return $errors;
	}
	
	
	
	public static function create($array){
		
		$sql = 'INSERT INTO pokemon(user_id, species_id, nickname, gender, ability,
					iv_hp, iv_atk, iv_def, iv_satk, iv_sdef, iv_speed,
					ev_hp, ev_atk, ev_def, ev_satk, ev_sdef, ev_speed,
					move1, move2, move3, move4)
				VALUES (:user_id, :species_id, :nickname, :gender, :ability,
				:iv_hp, :iv_atk, :iv_def, :iv_satk, :iv_sdef, :iv_speed,
				:ev_hp, :ev_atk, :ev_def, :ev_satk, :ev_sdef, :ev_speed,
				:move1, :move2, :move3, :move4) RETURNING id';
		
		$connection = DB::connection();
		$preparation = $connection->prepare($sql);
		
		$preparation->bindParam(':user_id', $array['user_id'], PDO::PARAM_INT);
		$preparation->bindParam(':species_id', $array['species_id'], PDO::PARAM_INT);
		$preparation->bindParam(':nickname', $array['nickname'], PDO::PARAM_STR);
		
		$preparation->bindValue(':gender', null, PDO::PARAM_INT);
		$preparation->bindValue(':ability', null, PDO::PARAM_INT);
		
		$preparation->bindValue(':iv_hp', null, PDO::PARAM_INT);
		$preparation->bindValue(':iv_atk', null, PDO::PARAM_INT);
		$preparation->bindValue(':iv_def', null, PDO::PARAM_INT);
		$preparation->bindValue(':iv_satk', null, PDO::PARAM_INT);
		$preparation->bindValue(':iv_sdef', null, PDO::PARAM_INT);
		$preparation->bindValue(':iv_speed', null, PDO::PARAM_INT);
		
		$preparation->bindValue(':ev_hp', null, PDO::PARAM_INT);
		$preparation->bindValue(':ev_atk', null, PDO::PARAM_INT);
		$preparation->bindValue(':ev_def', null, PDO::PARAM_INT);
		$preparation->bindValue(':ev_satk', null, PDO::PARAM_INT);
		$preparation->bindValue(':ev_sdef', null, PDO::PARAM_INT);
		$preparation->bindValue(':ev_speed', null, PDO::PARAM_INT);
		
		$preparation->bindValue(':move1', null, PDO::PARAM_INT);
		$preparation->bindValue(':move2', null, PDO::PARAM_INT);
		$preparation->bindValue(':move3', null, PDO::PARAM_INT);
		$preparation->bindValue(':move4', null, PDO::PARAM_INT);
		
        try{
            $preparation->execute();
        } catch (Exception $e){
          die('Virhe tietokantakyselyssä: ' . $e->getMessage());
        }
		
		return $preparation->fetchAll();
	}
	
	public static function update($id, $array){
		$sql = 'UPDATE pokemon SET
				   nickname = :nickname,
				   gender = :gender,
				   ability = :ability,
				   iv_hp = :iv_hp,
				   iv_atk = :iv_atk,
				   iv_def = :iv_def,
				   iv_satk = :iv_satk,
				   iv_sdef = :iv_sdef,
				   iv_speed = :iv_speed,
				   ev_hp = :ev_hp,
				   ev_atk = :ev_atk,
				   ev_def = :ev_def,
				   ev_satk = :ev_satk,
				   ev_sdef = :ev_sdef,
				   ev_speed = :ev_speed
				   WHERE id = :id';
		
		
		$connection = DB::connection();
		$preparation = $connection->prepare($sql);
		
		
		$preparation->bindParam(':nickname', $array['nickname'], PDO::PARAM_STR);
		
		if(empty($array['gender'])){
			$preparation->bindValue(':gender', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':gender', $array['gender'], PDO::PARAM_STR);
		}
		
		if(empty($array['ability'])){
			$preparation->bindValue(':ability', null, PDO::PARAM_STR);
		} else {
			$preparation->bindParam(':ability', $array['ability'], PDO::PARAM_STR);
		}
		
		if(empty($array['iv_hp'])){
			$preparation->bindValue(':iv_hp', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_hp', $array['iv_hp'], PDO::PARAM_INT);
		}
		if(empty($array['iv_atk'])){
			$preparation->bindValue(':iv_atk', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_atk', $array['iv_atk'], PDO::PARAM_INT);
		}
		if(empty($array['iv_def'])){
			$preparation->bindValue(':iv_def', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_def', $array['iv_def'], PDO::PARAM_INT);
		}
		if(empty($array['iv_satk'])){
			$preparation->bindValue(':iv_satk', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_satk', $array['iv_satk'], PDO::PARAM_INT);
		}
		if(empty($array['iv_sdef'])){
			$preparation->bindValue(':iv_sdef', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_sdef', $array['iv_sdef'], PDO::PARAM_INT);
		}
		if(empty($array['iv_speed'])){
			$preparation->bindValue(':iv_speed', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':iv_speed', $array['iv_speed'], PDO::PARAM_INT);
		}
		
		
		if(empty($array['ev_hp'])){
			$preparation->bindValue(':ev_hp', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_hp', $array['ev_hp'], PDO::PARAM_INT);
		}
		if(empty($array['ev_atk'])){
			$preparation->bindValue(':ev_atk', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_atk', $array['ev_atk'], PDO::PARAM_INT);
		}
		if(empty($array['ev_def'])){
			$preparation->bindValue(':ev_def', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_def', $array['ev_def'], PDO::PARAM_INT);
		}
		if(empty($array['ev_satk'])){
			$preparation->bindValue(':ev_satk', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_satk', $array['ev_satk'], PDO::PARAM_INT);
		}
		if(empty($array['ev_sdef'])){
			$preparation->bindValue(':ev_sdef', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_sdef', $array['ev_sdef'], PDO::PARAM_INT);
		}
		if(empty($array['ev_speed'])){
			$preparation->bindValue(':ev_speed', null, PDO::PARAM_INT);
		} else {
			$preparation->bindParam(':ev_speed', $array['ev_speed'], PDO::PARAM_INT);
		}
		
		$preparation->bindParam(':id', $id, PDO::PARAM_INT);
		
        try{
            $preparation->execute();
        } catch (Exception $e){
          die('Virhe tietokantakyselyssä: ' . $e->getMessage());
        }
	}
	
	public static function destroy($id){
		DB::query('DELETE FROM pokemon WHERE id = :id', array('id' => $id));
	}
	
	
	public static function setmove($pid, $moveno, $moveid){
		if($moveno == 1){
			DB::query('UPDATE pokemon SET move1 = :moveid WHERE id = :id', array('moveid' => $moveid, 'id' => $pid));
		} else if($moveno == 2){
			DB::query('UPDATE pokemon SET move2 = :moveid WHERE id = :id', array('moveid' => $moveid, 'id' => $pid));
		} else if($moveno == 3){
			DB::query('UPDATE pokemon SET move3 = :moveid WHERE id = :id', array('moveid' => $moveid, 'id' => $pid));
		} else if($moveno == 4){
			DB::query('UPDATE pokemon SET move4 = :moveid WHERE id = :id', array('moveid' => $moveid, 'id' => $pid));
		}
	}
	
	public static function delmove($pid, $moveno){
		if($moveno == 1){
			DB::query('UPDATE pokemon SET move1 = null WHERE id = :id', array('id' => $pid));
		} else if($moveno == 2){
			DB::query('UPDATE pokemon SET move2 = null WHERE id = :id', array('id' => $pid));
		} else if($moveno == 3){
			DB::query('UPDATE pokemon SET move3 = null WHERE id = :id', array('id' => $pid));
		} else if($moveno == 4){
			DB::query('UPDATE pokemon SET move4 = null WHERE id = :id', array('id' => $pid));
		}
	}
	
	public static function all(){
		
		$pokemon = array();
		$rows = DB::query('SELECT * FROM pokemon');
		
		foreach($rows as $row){
			$pokemon[] = new Pokemon(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'species_id' => $row['species_id'],
				'nickname' => $row['nickname'],
				'gender' => $row['gender'],
				'ability' => $row['ability'],
				'iv_hp' => $row['iv_hp'],
				'iv_atk' => $row['iv_atk'],
				'iv_def' => $row['iv_def'],
				'iv_satk' => $row['iv_satk'],
				'iv_sdef' => $row['iv_sdef'],
				'iv_speed' => $row['iv_speed'],
				'ev_hp' => $row['ev_hp'],
				'ev_atk' => $row['ev_atk'],
				'ev_def' => $row['ev_def'],
				'ev_satk' => $row['ev_satk'],
				'ev_sdef' => $row['ev_sdef'],
				'ev_speed' => $row['ev_speed'],
				'move1' => $row['move1'],
				'move2' => $row['move2'],
				'move3' => $row['move3'],
				'move4' => $row['move4']
			));
		}
		
		return $pokemon;
	}
	
	
	public static function findByUser($user_id){
		$pokemon = array();
		$rows = DB::query('
			SELECT		pokemon.id,
							user_id,
							species.id AS species_id,
							nickname,
							gender,
							ability,
							iv_hp,
							iv_atk,
							iv_def,
							iv_satk,
							iv_sdef,
							iv_speed,
							ev_hp,
							ev_atk,
							ev_def,
							ev_satk,
							ev_sdef,
							ev_speed,
							move1,
							move2,
							move3,
							move4,
							name,
							dexno,
							type1,
							type2
			FROM pokemon
			INNER JOIN species ON pokemon.species_id = species.id
			WHERE user_id = :user_id
			', array('user_id' => $user_id)); 
		
		foreach($rows as $row){
			$pokemon[] = new Pokemon(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'species_id' => $row['species_id'],
				'nickname' => $row['nickname'],
				'gender' => $row['gender'],
				'ability' => $row['ability'],
				'iv_hp' => $row['iv_hp'],
				'iv_atk' => $row['iv_atk'],
				'iv_def' => $row['iv_def'],
				'iv_satk' => $row['iv_satk'],
				'iv_sdef' => $row['iv_sdef'],
				'iv_speed' => $row['iv_speed'],
				'ev_hp' => $row['ev_hp'],
				'ev_atk' => $row['ev_atk'],
				'ev_def' => $row['ev_def'],
				'ev_satk' => $row['ev_satk'],
				'ev_sdef' => $row['ev_sdef'],
				'ev_speed' => $row['ev_speed'],
				'move1' => $row['move1'],
				'move2' => $row['move2'],
				'move3' => $row['move3'],
				'move4' => $row['move4'],
				'species_name' => $row['name'],
				'species_dexno' => $row['dexno'],
				'species_type1' => $row['type1'],
				'species_type2' => $row['type2']
			));
		}
		
		return $pokemon;
	}
	
	public static function findById($id){
		$rows = DB::query('SELECT * FROM pokemon WHERE id = :id LIMIT 1', array('id' => $id));
		
		if(count($rows) > 0){
			$row = $rows[0];
			
			$pokemon[] = new Pokemon(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'species_id' => $row['species_id'],
				'nickname' => $row['nickname'],
				'gender' => $row['gender'],
				'ability' => $row['ability'],
				'iv_hp' => $row['iv_hp'],
				'iv_atk' => $row['iv_atk'],
				'iv_def' => $row['iv_def'],
				'iv_satk' => $row['iv_satk'],
				'iv_sdef' => $row['iv_sdef'],
				'iv_speed' => $row['iv_speed'],
				'ev_hp' => $row['ev_hp'],
				'ev_atk' => $row['ev_atk'],
				'ev_def' => $row['ev_def'],
				'ev_satk' => $row['ev_satk'],
				'ev_sdef' => $row['ev_sdef'],
				'ev_speed' => $row['ev_speed'],
				'move1' => $row['move1'],
				'move2' => $row['move2'],
				'move3' => $row['move3'],
				'move4' => $row['move4']
			));
			
			return $pokemon;
		}
		
		return null;
	}
		
	
  }
