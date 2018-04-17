<?php

class VIEW {
	
	public static $view;
	
	public static function init($viewtype, $config){
		self::$view = new $viewtype;
		foreach($config as $key => $value){
			self::$view->$key = $value;
		}
		//print_r(self::$view->template_dir);
	}
	
	public static function showConfig(){
		print_r(self::$view->template_dir);
	}
	
	public static function assign($data){
		foreach($data as $key=>$value){
			self::$view->assign($key, $value);
		}
	}
	
	public static function display($template){
		self::$view->display($template);
	}
}