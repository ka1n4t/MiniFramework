<?php
	class newsModel {
		
		private $_table = 'news';
		
		public function counts() {
			return DB::counts($this->_table);
		}
		
		public function getNewsInfo($id) {
			return DB::getOneRow($this->_table, "id = $id");
		}
		
		public function getNewsList() {
			$data = DB::getList($this->_table);
			foreach($data as $key => $value) {
				$data[$key]['content'] = mb_substr(strip_tags($data[$key]['content']), 0, 200);
				$data[$key]['dateline'] = date('Y-m-d H:i:s', $data[$key]['dateline']);
			}
			
			return $data;
		}
		
		public function newsSubmit($data) {
			extract($data);
			if( empty($title) || empty($content) ) { // 标题或内容为空
				return 0;
			}
			
			$data = array(
				'title' => addslashes($title),
				'content' => addslashes($content),
				'author' => addslashes($author),
				'source' => addslashes($source),
				'dateline' => time()
			);
			
			if(empty($_POST['id'])) {
				DB::insert($this->_table, $data);
				return 1;
			} else {
				DB::update($this->_table, $data, "id=$id");
				return 2;
			}
		}
		
		public function getList() {
			return DB::getList($this->_table);
		}
		
		public function newsDel() {
			$id = intval($_GET['id']);
			$where = "id = $id";
			return DB::del($this->_table, $where);
		}
		
	}

?>