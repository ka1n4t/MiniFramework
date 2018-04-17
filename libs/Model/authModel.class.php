<?php
	class authModel {
		
		private $auth = null;
		
		public function __contruct() {
			
			
		}
		
		public function loginSubmit() {
			if(empty($_POST['username']) || empty($_POST['password'])) {
				return false;
			}
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			if($this->auth = $this->checkUser($username, $password)) { // 使用本类的另一个方法，低耦合
				$_SESSION['account'] = $this->auth['username'];
				$_SESSION['accountId'] = $this->auth['id'];
				$_SESSION['is_login'] = 1;
				return true;
			} else {
				return false;
			}
		}
		
		public function checkUser($username, $password) {
			$adminObj = M('admin');
			$info = $adminObj->findUserInfo($username);
			
			if(empty($info)) {
				return 0; //0为不存在该用户
			}
			if($info['password'] == md5($password)) {
				return $info;
			} else {
				return false;
			}
		}
		
		public function logout() {
			unset($_SESSION['auth']);
			$this->auth = null;
		}
		
		
	}


?>