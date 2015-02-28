<?php

  class UserController extends BaseController{

    public static function login(){
   	  self::render_view('login.html');
    }
	
	public static function signin(){
   	  self::render_view('sign_in.html');
    }
	
	public static function handle_signin(){
		$params = $_POST;
		  $attributes = array(
		    'name' => $params['name'],
			'password' => $params['password']
			);
		
		$user = new User($attributes);
		$errors = $user->errors();
		
		if(count($errors) == 0){
			$id = User::create($attributes);
		    self::redirect_to('/', array('message' => 'Account has been made. Please log in!'));
		}
		else {
			self::render_view('/sign_in.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		
		exit();
	}
	
	public static function handle_login(){
		$params = $_POST;
		$user = User::authenticate($params['username'], $params['password']);
		$preuser = self::get_user_logged_in();
		
		if(!$user){
          self::redirect_to('/login', array('error' => 'Wrong username or password'));
		}
		else if($user == $preuser){
			self::redirect_to('/', array('error' => 'You are already logged in.', 'user' => $user));
		}
		else {
			
			$_SESSION['user'] = $user->id;
			self::redirect_to('/', array('message' => 'You have logged in', 'user' => $user));
		}
	}
	
	public static function logout(){
		$_SESSION['user'] = null;
		
		self::redirect_to('/', array('message' => 'You have logged out.'));
	}
	
  }

  
 