<?php

//composer ei tosiaankaan tullut bootstrap.sh mukana

  class HelloWorldController extends BaseController{

    public static function index(){
   	  self::render_view('home.html');
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
	
    public static function test1(){
      // Testaa koodiasi täällä	
      self::render_view('login.html');
    }

	/*
    public static function test2(){
      // Testaa koodiasi täällä	
      self::render_view('move_list.html');
    }
	*/
	
    public static function test3(){
      // Testaa koodiasi täällä	
      self::render_view('move_list_admin.html');
    }

    public static function test4(){
      // Testaa koodiasi täällä	
      self::render_view('move_edit_admin.html');
    }

    public static function test5(){
      // Testaa koodiasi täällä	
      self::render_view('species_list.html');
    }

    public static function test6(){
      // Testaa koodiasi täällä	
      self::render_view('species_list_admin.html');
    }

    public static function test7(){
      // Testaa koodiasi täällä	
      self::render_view('pokemon_list.html');
    }

    public static function test8(){
      // Testaa koodiasi täällä	
      self::render_view('pokemon_show.html');
    }

    public static function test9(){
      // Testaa koodiasi täällä	
      self::render_view('species_edit_admin.html');
    }

    public static function test10(){
      // Testaa koodiasi täällä	
      self::render_view('species_show.html');
    }

    public static function test11(){
      // Testaa koodiasi täällä	
      self::render_view('frontpage.html');
    }
  }
