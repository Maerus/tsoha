<?php

  class PokemonController extends BaseController{
	  
	  
	  
	  public static function index($user_id){
		self::check_logged_in();
		$user = self::get_user_logged_in();
		self::check_correct_user($user, $user_id);
		
		$pokemon = Pokemon::findByUser($user_id);
		self::render_view('pokemon/list.html', array('pokemon' => $pokemon));
	  }
	  
	  
	  public static function show($pokemon_id){ 
		self::check_logged_in();
		$pokemon = Pokemon::findById($pokemon_id);
		$user = self::get_user_logged_in();
		self::check_correct_user($user, $pokemon[0]->user_id);
		
		$sid = $pokemon[0]->species_id;
		$species = Species::findById($sid);
		
		$move1 = Move::findById($pokemon[0]->move1);
		$move2 = Move::findById($pokemon[0]->move2);
		$move3 = Move::findById($pokemon[0]->move3);
		$move4 = Move::findById($pokemon[0]->move4);
		
        self::render_view('pokemon/show.html', array('pokemon' => $pokemon[0],
																			'species' => $species,
																			'move1' => $move1,
																			'move2' => $move2,
																			'move3' => $move3,
																			'move4' => $move4));
      }
	  
	  public static function showmove($id, $moveno){
		  self::check_logged_in();
		  $pokemon = Pokemon::findById($id);
		  $user = self::get_user_logged_in();
		  self::check_correct_user($user, $pokemon[0]->user_id);
		  $sid = $pokemon[0]->species_id;
		  $moves = Move::all();
		  $junction = MoveOfSpecies::findBySpeciesId($sid);
		  
		  $array = array();
		  if(is_array($junction)){
		  	foreach($junction as $row){
		  		$array[] = $row->move_id;
		  	}
		  }
		  else if($junction != null){
		  	$array[] = $junction->move_id;
		  }
		  self::render_view('pokemon/move_edit.html', array('moves' => $moves, 'array' => $array, 'pokemon_id' => $id, 'moveno' =>$moveno));
	  }
	  
	  public static function setmove($pid, $moveno, $moveid){
		  self::check_logged_in();
		  $pokemon = Pokemon::findById($pid);
		  $user = self::get_user_logged_in();
		  self::check_correct_user($user, $pokemon[0]->user_id);
		  Pokemon::setmove($pid, $moveno, $moveid);
		  self::redirect_to('/pokemon/show/'.$pid);
		  exit();
	  }
	  
	  
	  public static function delmove($pid, $moveno){
		  self::check_logged_in();
		  $pokemon = Pokemon::findById($pid);
		  $user = self::get_user_logged_in();
		  self::check_correct_user($user, $pokemon[0]->user_id);
		  Pokemon::delmove($pid, $moveno);
		  self::redirect_to('/pokemon/show/'.$pid);
		  exit();
	  }
	  
	 
	  public static function store(){
		  $params = $_POST;
		  $attributes = array(
		    'user_id' => $params['user_id'],
			'species_id' => $params['species_id'],
			'nickname' => $params['name']
			);
			
		  $id = Pokemon::create($attributes);
		  
		  self::redirect_to('/species/list', array('message' =>$params['name'].' has been added to your Pokemon'));
		  
		  exit();
	  }
	   
	  public static function update($id){
		self::check_logged_in();
		$pokemon = Pokemon::findById($id);
		$user = self::get_user_logged_in();
		self::check_correct_user($user, $pokemon[0]->user_id);
		
		$params = $_POST;
		$attributes = array(
			'nickname' => $params['nickname'],
			'gender' => $params['gender'],
			'ability' => $params['ability'],
			'iv_hp' => $params['iv_hp'],
			'iv_atk' => $params['iv_atk'],
			'iv_def' => $params['iv_def'],
			'iv_satk' => $params['iv_satk'],
			'iv_sdef' => $params['iv_sdef'],
			'iv_speed' => $params['iv_speed'],
			'ev_hp' => $params['ev_hp'],
			'ev_atk' => $params['ev_atk'],
			'ev_def' => $params['ev_def'],
			'ev_satk' => $params['ev_satk'],
			'ev_sdef' => $params['ev_sdef'],
			'ev_speed' => $params['ev_speed']
			);
		
		$e_pokemon = new Pokemon($attributes);
		$errors = $e_pokemon->errors();
		
		$sid = $pokemon[0]->species_id;
		$species = Species::findById($sid);
		$move1 = Move::findById($pokemon[0]->move1);
		$move2 = Move::findById($pokemon[0]->move2);
		$move3 = Move::findById($pokemon[0]->move3);
		$move4 = Move::findById($pokemon[0]->move4);
		
		if(count($errors) > 0){
			self::render_view('pokemon/show.html', array('errors' => $errors,
																				'pokemon' => $pokemon[0],
																				'species' => $species,
																				'move1' => $move1,
																				'move2' => $move2,
																				'move3' => $move3,
																				'move4' => $move4));
		}
		else{
			Pokemon::update($id, $attributes);
			$pokemon = Pokemon::findById($id);
			self::render_view('pokemon/show.html', array('message' => 'Pokemon has been edited successfully',
																				'pokemon' => $pokemon[0],
																				'species' => $species,
																				'move1' => $move1,
																				'move2' => $move2,
																				'move3' => $move3,
																				'move4' => $move4));
		}
		
		exit();
	  }
	  
	  public static function destroy($id){
		  self::check_logged_in();
		  $pokemon = Pokemon::findById($id);
		  $user = self::get_user_logged_in();
		  $uid = $pokemon[0]->user_id;
		  self::check_correct_user($user, $uid);
		  $name = $pokemon[0]->nickname;
		  Pokemon::destroy($id);
		  self::redirect_to('/pokemon/list/'.$uid, array('message' => $name.' has been deleted'));
		  
	  }
	  
	  
	  
  }
  
 
  
  
  
  
  
