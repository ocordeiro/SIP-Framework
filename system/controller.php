<?php

class Controller {

	
	public function loadModel( $name = '' )
	{
		if ( !class_exists( $name ) )
		{
			require(APP_DIR .'models/'. strtolower($name) .'.php');
			$model = new $name;
			list($model->table) = explode('_',strtolower($name));
			return $model;
		}
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc){
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
	}

	public function request($par = null){
		if(is_array($par)){
			$request = Array();
			foreach($par as $field){
				$request[$field] = isset($_REQUEST[$field]) ? $_REQUEST[$field] : false;
			}
			return $request;
		}else if(is_null($par)){
			return $_REQUEST;
		}else{
			return isset($_REQUEST[$par]) ? $_REQUEST[$par] : false;	
		}
		
	}
    
}

?>