<?php

  class MoveController extends BaseController{
	  
	  // etusivu (liikkeiden listaus - user)
	  public static function index(){
		  $moves = Move::all();
		  
		  self::render_view('move_list.html', array('moves' => $moves));
	  }
	  
	  
	  public static function movelist_a(){
		  $moves = Move::all();
		  
		  self::render_view('move_list_admin.html', array('moves' => $moves));
	  }
	  
	  
	   public static function moveedit_a($id){
		   
		  $move = Move::findById($id);
		  
		  self::render_view('move_edit_admin.html', array('move' => $move));
	  }
	  
	  public static function store(){
		  
		  $params = $_POST;
		  
		  $id = Move::create(array(
			'name' => $params['name'],
			'type' => $params['type'],
			'category' => $params['category'],
			'power' => $params['power'],
			'accuracy' => $params['accuracy'],
			'pp' => $params['pp'],
			'description' => $params['description']
		  ));
		  
		  self::redirect_to('/move_list_a', array('message' => 'Move added to database.'));
		  exit();
	  }
	  
	  public static function create(){
		  
		  self::render_view('move_new_admin.html');
		  
	  }
	  
  }
  
  
  
  
  
  
  
