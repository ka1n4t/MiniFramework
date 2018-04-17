<?php

	class AdminModel {
		
		public $_table = 'admin';
		
		function findUserInfo($username) {
			$where = "username = '$username'";
			return DB::getOneRow($this->_table, $where);
		}
	}

?>