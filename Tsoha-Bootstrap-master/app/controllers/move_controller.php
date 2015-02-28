<?php

  class MoveController extends BaseController{
	  
	  // etusivu (liikkeiden listaus - user)
	  public static function index(){
		  $moves = Move::all();
		  
		  self::render_view('move/list.html', array('moves' => $moves));
	  }
	  
	  
	  public static function movelist_a(){
		  self::check_logged_in();
		  $user = self::get_user_logged_in();
		  self::check_admin($user);
		  
		  $moves = Move::all();
		  
		  self::render_view('move/list_admin.html', array('moves' => $moves));
	  }
	  
	  
	   public static function moveedit_a($id){
		   self::check_logged_in();
		  $user = self::get_user_logged_in();
		  self::check_admin($user);
		   
		  $move = Move::findById($id);
		  
		  self::render_view('move/edit_admin.html', array('move' => $move));
	  }
	  
	  
	  
	  public static function store(){
		  
		  $params = $_POST;
		  
		  $attributes = array('name' => $params['name'],
			'type' => $params['type'],
			'category' => $params['category'],
			'power' => $params['power'],
			'accuracy' => $params['accuracy'],
			'pp' => $params['pp'],
			'description' => $params['description']);
		  
		  $move = new Move($attributes);
		  $moveerror = $move->validate_name();
		  $othererrors = $move->errors();
		  $errors = array_merge($moveerror, $othererrors);
		  
		  if(count($errors) == 0){
			  $id = Move::create($attributes);
		  
		      self::redirect_to('/move/list_a', array('message' => 'Move added to database.'));
		  }
		  else {
			  self::render_view('/move/new_admin.html', array('errors' => $errors, 'attributes' => $attributes));
		  }
		  
		  exit();
	  }
	  
	  
	  public static function edit($id){
		  self::check_logged_in();
		  $user = self::get_user_logged_in();
		  self::check_admin($user);
		  
		  
        $move = Move::findById($id);
     
        self::render_view('move/edit_admin.html', array('attributes' => $move));
      }
	  
	  public static function update($id){
		$move = Move::findById($id);
		$params = $_POST;
		$attributes = array('type' => $params['type'],
			'category' => $params['category'],
			'power' => $params['power'],
			'accuracy' => $params['accuracy'],
			'pp' => $params['pp'],
			'description' => $params['description']);
		$e_move = new Move($attributes);
		$errors = $e_move->errors();
		
		
		if(count($errors) > 0){
			self::render_view('move/edit_admin.html', array('errors' => $errors, 'move' => $move));
		}
		else{
			Move::update($id, $attributes);
			self::redirect_to('/move/list_a', array('message' => 'Move has been edited successfully'));
		}
		
		exit();
	  }
	  
	  public static function destroy($id){
		  Move::destroy($id);
		  self::redirect_to('/move/list_a', array('message' => 'Move has been deleted'));
		  //self::redirect_to('/move/list_a/', array('message' => 'Move has been deleted.'));
		  
	  }
	  
	  
	  
	  
	  
	  public static function create(){
		  self::check_logged_in();
		  $user = self::get_user_logged_in();
		  self::check_admin($user);
		  
		  self::render_view('move/new_admin.html');
		  
	  }
	  
  }
  
  
  
  
  
  
  
