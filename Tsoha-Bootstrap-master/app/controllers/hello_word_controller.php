<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  self::render_view('frontpage.html');
    }

	/*
    public static function sandbox(){
      // Testaa koodiasi täällä	
      self::render_view('helloworld.html');
    }
	*/
	
	public static function sandbox(){
		//$moves = MoveOfSpecies::all();
		//print_r($moves);
		
		$mon = Pokemon::all();
		print_r($mon);
		print_r('////////////////////');
		
		/*
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
			', array('user_id' => 1));
		print_r($rows);
		*/
    }
	
}
