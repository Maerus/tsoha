<?php

  class SpeciesController extends BaseController{
	  
	  public static function index(){
		  $species = Species::all();
		  
		  self::render_view('species/list.html', array('species' => $species));
	  }
	  
	  
	  public static function specieslist_a(){
		  $species = Species::all();
		  
		  self::render_view('species/list_admin.html', array('species' => $species));
	  }
	  
	  
	   public static function speciesedit_a($id){
		   
		  $species = Species::findById($id);
		  
		  self::render_view('species/edit_admin.html', array('species' => $species));
	  }
	  
	  public static function show($id){
        $species = Species::findById($id);
     
        self::render_view('species/show.html', array('species' => $species));
      }
	  
	  public static function store(){
		  $params = $_POST;
		  $attributes = array(
		    'name' => $params['name'],
			'dexno' => $params['dexno'],
			'type1' => $params['type1'],
			'type2' => $params['type2'],
			'ability1' => $params['ability1'],
			'ability2' => $params['ability2'],
			'hability1' => $params['hability1'],
			'hability2' => $params['hability2'],
			'base_hp' => $params['base_hp'],
			'base_atk' => $params['base_atk'],
			'base_def' => $params['base_def'],
			'base_satk' => $params['base_satk'],
			'base_sdef' => $params['base_sdef'],
			'base_speed' => $params['base_speed']
			);
		  
		  $species = new Species($attributes);
		  $specieserror = $species->validate_name();
		  $dexerror = $species->validate_dex();
		  $merge = array_merge($specieserror, $dexerror);
		  $othererrors = $species->errors();
		  $errors = array_merge($merge, $othererrors);
		  
		  if(count($errors) == 0){
			  $id = Species::create($attributes);
		  
		      self::redirect_to('/species/list_a', array('message' => 'Species added to database.'));
		  }
		  else {
			  self::render_view('/species/new_admin.html', array('errors' => $errors, 'attributes' => $attributes));
		  }
		  
		  exit();
	  }
	  
	  
	  public static function edit($id){
        $species = Species::findById($id);
     
        self::render_view('species/edit_admin.html', array('attributes' => $species));
      }
	  
	  public static function update($id){
		$species = Species::findById($id);
		$params = $_POST;
		$attributes = array(
			'type1' => $params['type1'],
			'type2' => $params['type2'],
			'ability1' => $params['ability1'],
			'ability2' => $params['ability2'],
			'hability1' => $params['hability1'],
			'hability2' => $params['hability2'],
			'base_hp' => $params['base_hp'],
			'base_atk' => $params['base_atk'],
			'base_def' => $params['base_def'],
			'base_satk' => $params['base_satk'],
			'base_sdef' => $params['base_sdef'],
			'base_speed' => $params['base_speed']
			);
			
		$e_species = new Species($attributes);
		$errors = $e_species->errors();
		
		
		if(count($errors) > 0){
			self::render_view('species/edit_admin.html', array('errors' => $errors, 's' => $species));
		}
		else{
			Species::update($id, $attributes);
			self::redirect_to('/species/list_a', array('message' => 'Species has been edited successfully'));
		}
		
		exit();
	  }
	  
	  public static function destroy($id){
		  Species::destroy($id);
		  self::redirect_to('/species/list_a', array('message' => 'Species has been deleted'));
		  
	  }
	  
	  
	  public static function create(){
		  
		  self::render_view('species/new_admin.html');
		  
	  }
	   
  }
  
 
  
  
  
  
  
