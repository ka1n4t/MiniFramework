<?php
	//工厂模式
	class DB{
		
		public static $db;
		
		public static function init($dbtype, $config){
			self::$db = new $dbtype;
			self::$db->connect($config);
		}
		
		public static function counts($table){
			return self::$db->counts($table);
		}
		
		public static function query($sql){
			return self::$db->query($sql);
		}
		
		public static function getOneRow($table, $where, $target='*') {
			return self::$db->getOneRow($table, $where, $target);
		}
		
		public static function findAll($sql){
			$query = self::$db->query($sql);
			return self::$db->findAll($query);
		}
		
		public static function getList($table, $where = '') {
			return self::$db->getList($table, $where);
		}
		
		public static function findOne($sql){
			$query = self::$db->query($sql);
			return self::$db->findOne($query);
		}
		
		public static function findResult($sql, $row = 0, $filed = 0){
			$query = self::$db->query($sql);
			return self::$db->findResult($query, $row, $filed);
		}

		public static function insert($table,$arr){
			return self::$db->insert($table,$arr);
		}
	
		public static function update($table, $arr, $where){
			return self::$db->update($table, $arr, $where);
		}
	
		public static function del($table,$where){
			return self::$db->del($table,$where);
		}
		
		
		
	}