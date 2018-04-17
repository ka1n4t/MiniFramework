<?php
	//框架入口文件
	$currentdir = dirname(__FILE__);
	require_once($currentdir.'/include.list.php');
	foreach($paths as $path){
		require_once($currentdir.'/'.$path);
	}
	
	class PC{
		public static $controller;
		public static $method;
		private static $config;

		private static function init_db(){
			DB::init('mysql', self::$config['dbconfig']);
		}
		
		private static function init_view(){
			VIEW::init('Smarty', self::$config['viewconfig']);
		}
		
		private static function init_controller(){
			self::$controller = isset($_GET['controller'])?$_GET['controller']:'index';
		}
		
		private static function init_method(){
			self::$method = isset($_GET['method'])?$_GET['method']:'index';
		}

		public static function run($config){
			self::$config = $config;
			self::init_db();
			self::init_view();
			self::init_controller();
			self::init_method();
			C(self::$controller, self::$method);
		}
	}


?>