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
		$moves = Move::all();
		print_r($moves);
		
		$moves = Move::findByType('Fire');
		print_r($moves);
    }
	
}
