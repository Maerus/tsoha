<?php

  class UserController extends BaseController{

    public static function login(){
   	  self::render_view('login.html');
    }
	
	public static function handle_login(){
		$params = $_POST;
		$user = User::authenticate($params['username'], $params['password']);
		$preuser = self::get_user_logged_in();
		
		if(!$user){
          self::redirect_to('/login', array('error' => 'Wrong username or password'));
		}
		else if($user == $preuser){
			self::redirect_to('/', array('error' => 'You are already logged in.'));
		}
		else {
			
			$_SESSION['user'] = $user->id;
			self::redirect_to('/', array('message' => 'You have logged in :)'));
		}
	}
  }

  
 