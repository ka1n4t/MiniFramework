<?php
	function C($name, $method){
		require_once("libs/Controller/$name"."Controller.class.php");
		$controllerName = $name."Controller";
		$obj = new $controllerName();
		return $obj->$method();
	}
	
	function M($name){
		require_once("libs/Model/$name"."Model.class.php");
		$modelName = $name."Model";
		$obj = new $modelName();
		return $obj;
	}
	
	function V($name){
		require_once("libs/View/$name"."View.class.php");
		$viewName = $name."View";
		$obj = new $viewName();
		return $obj;
	}
	
?>