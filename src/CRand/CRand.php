<?php

class CRand implements ISingleton {

	private static $instance = null;

	

	private function __construct(){
		$rd = &$this;
		require(RAND_SITE_PATH . '/config.php');
	}

	public static function Instance(){
		if(self::$instance == null) {
		   self::$instance  = new CRand();
		}
		return self::$instance;
	}

	

	// Front controller Route, check url and route to controller

	public function FrontControllerRoute() {
		// Step 1
		// Take current url and divide it in controller, method and parameters
		$this->request = new CRequest($this->config['base_url']);
		$this->request->Init();
		$controller = $this->request->controller;
		$method = $this->request->method;
		$arguments = $this->request->arguments;

		$controllerExists = isset($this->config['controllers'][$controller]);
		$controllerEnabled = false;
		$className = false;
		$classExists = false;

		if($controllerExists){
			$controllerEnabled    = ($this->config['controllers'][$controller]['enabled'] == true);
			$className               = $this->config['controllers'][$controller]['class'];
			$classExists           = class_exists($className);
		}



		// Step 2
		// Check if there is a callable method in the controller class, if then call it

		if($controllerExists && $controllerEnabled && $classExists){
			$rc = new ReflectionClass($className);
			if($rc->implementsInterface('IController')){
				if($rc->hasMethod($method)){
					$controllerObj = $rc->newInstance();
					$methodObj = $rc->getMethod($method);
					$methodObj->invokeArgs($controllerObj, $arguments);
				} else {
					die("404. " . get_class() . ' error: Controller does not contain method.');
				}
	        } else {
	        	die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
				}
		} else { 
			die('404. Page is not found.');
		}
	


		$this->data['debug']  = "REQUEST_URI - {$_SERVER['REQUEST_URI']}\n";
		$this->data['debug'] .= "SCRIPT_NAME - {$_SERVER['SCRIPT_NAME']}\n";
	}

	//Theme engine render, renders views using the selected theme
	public function ThemeEngineRender(){
		// Get the path and settings for the Theme
		$themeName = $this->config['theme']['name'];
		$themePath = RAND_INSTALL_PATH . "/themes/{$themeName}";
		$themeUrl = $this->request->base_url . "themes/{$themeName}"; 

		//Add stylesheet
		$this->data['stylesheet'] = "{$themeUrl}/style.css";

		//Include global functions and functions.php from the theme
		$rd = &$this;
		$globalFunctions = RAND_INSTALL_PATH . "themes/functions.php";
		if(is_file($globalFunctions)){
			include $globalFunctions;
		}
		$functionsPath = "{$themePath}/functions.php";
		if(is_file($functionsPath)){
			include $functionsPath;
		}

		extract($this->data);
		include("{$themePath}/default.tpl.php");



	}




}