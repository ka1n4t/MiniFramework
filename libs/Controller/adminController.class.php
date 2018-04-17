<?php

	class adminController {
		
		public function __construct() {
			if(!isset($_SESSION['is_login']) && PC::$method != 'login') {
				$this->showMessage('未登录， 登录后再操作...', 'admin.php?controller=admin&method=login');
				exit();
			}
		}
		
		public function index() {
			$obj = M('news');
			$counts = $obj->counts();
			VIEW::assign(array('newsnum' => $counts));
			VIEW::display('admin/index.html');
		}
		
		public function newsadd() {
			if(empty($_POST)){//没有post数据，则显示添加/修改界面
				if(isset($_GET['id'])) {
					//有文章id的话显示旧数据
					$newsId = $_GET['id'];
					$obj = M('news');
					$data = $obj->getNewsInfo($newsId);
				} else {
					$data = array();
				}
				VIEW::assign(array('data' => $data));
				VIEW::display("admin/newsadd.html");
			} else {
				//有POST数据，直接进行添加/修改等逻辑操作	
				$this->adjustNewsRet();
			}
			
			
		}
		
		public function adjustNewsRet() {
			$obj = M('news');
			$isOk = $obj->newsSubmit($_POST);
			if($isOk == 0) {
				$this->showMessage('文章标题或内容不能为空', 'admin.php?controller=admin&method=newsadd&id='.$_POST['id']);
			} elseif ($isOk == 1) {
				$this->showMessage('文章添加成功', 'admin.php?controller=admin&method=newslist');
			} else { // $isOk == 2
				$this->showMessage('文章修改成功', 'admin.php?controller=admin&method=newslist');
			}
		}
		
		public function newslist() {
			$data = M('news')->getList();
			VIEW::assign(array('data' => $data));
			VIEW::display('admin/newslist.html');
		}
		
		public function newsdel() {
			if($_GET['id']) {
				$obj = M('news');
				$obj->newsdel();
				$this->showMessage('文章删除成功', 'admin.php?controller=admin&method=newslist');				
			}

		}
		
		public function login() {
			if(isset($_POST['submit'])) {
				$this->checkLogin();
				
			} else {
				session_destroy();
				VIEW::display('admin/login.html');
			}
		}
		
		public function checkLogin() {
			$authObj = M('auth');
			if($authObj->loginSubmit()) {
				$this->showMessage('登录成功！', 'admin.php?controller=admin&method=index');
			} else {
				$this->showMessage('登录失败！', 'admin.php?controller=admin&method=login');
			}
		}
		
		public function logout() {
			$authObj = M('auth');
			$authObj->logout();
			$this->showMessage('登出成功！', 'admin.php?controller=admin&method=login');
		}
		
		public function showMessage($text, $loc) {
			echo "<script>alert('$text');window.location.href='$loc';</script>";
			exit();
		}
	}

?>