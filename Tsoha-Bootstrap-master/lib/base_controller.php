<?php

  class BaseController{

    public static function get_user_logged_in(){
		if(isset($_SESSION['user'])){
			$user_id = $_SESSION['user'];
			$user = User::findById($user_id);
			
			return $user;
		}
		
		return null;
    }

    public static function check_logged_in(){
		
		if(!isset($_SESSION['user'])){
			self::redirect_to('/login', array('message' => 'Please log in.'));
		}
		
    }
	
	public static function check_correct_user($user, $target_id){
		
		if($user->id != $target_id){
			self::redirect_to('/', array('alert' => 'The requested page is not available to you.'));
		}
		
    }
	
	public static function check_admin($user){
		
		if($user->name != 'AdminAuthority'){
			self::redirect_to('/', array('alert' => 'The requested page is not available to you.'));
		}
		
    }

    public static function render_view($view, $content = array()){
      Twig_Autoloader::register();

      $twig_loader = new Twig_Loader_Filesystem('app/views');
      $twig = new Twig_Environment($twig_loader);

      try{
        if(isset($_SESSION['flash_message'])){

          $flash = json_decode($_SESSION['flash_message']);

          foreach($flash as $key => $value){
            $content[$key] = $value;
          }

          unset($_SESSION['flash_message']);
        }

        $content['base_path'] = self::base_path();

        if(method_exists(__CLASS__, 'get_user_logged_in')){
          $content['user_logged_in'] = self::get_user_logged_in();
        }

        echo $twig->render($view, $content);
      } catch (Exception $e){
        die('Virhe näkymän näyttämisessä: ' . $e->getMessage());
      }

      exit();
    }

    public static function redirect_to($location, $message = null){
      if(!is_null($message)){
        $_SESSION['flash_message'] = json_encode($message);
      }

      header('Location: ' . self::base_path() . $location);

      exit();
    }

    public static function render_json($object){
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($object);

      exit();
    }

    public static function base_path(){
      $script_name = $_SERVER['SCRIPT_NAME'];
      $explode =  explode('/', $script_name);

      if($explode[1] == 'index.php'){
        $base_folder = '';
      }else{
        $base_folder = $explode[1];
      }

      return '/' . $base_folder;
    }

  }
