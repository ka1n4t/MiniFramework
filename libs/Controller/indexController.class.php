<?php
	class indexController {
		
		public function index() {
			$obj = M('news');
			$data = $obj->getNewsList();
			//$this->showabout();
			VIEW::assign(array('data' => $data));
			VIEW::display('index/index.html');
		}
		
		public function newsshow() {
			$id = intval($_GET['id']);
			$obj = M('news');
			$data = $obj->getNewsInfo($id);
			//$this->showabout();
			VIEW::assign(array('data' => $data));
			VIEW::display('index/show.html');
		}
		
		public function about() {
			$data = M('about')->aboutInfo();
			VIEW::assign(array('about' => $data));
			VIEW::display('index/about.html');
		}
	}
?>